<?php

namespace app\modules\cabinet\models;

use app\behaviors\EventBehavior;
use app\behaviors\GenerateRandomStringBehavior;
use app\behaviors\HashBehavior;
use app\behaviors\TagDependencyBehavior;
use app\behaviors\TimestampBehavior;
use Yii;
use yii\base\Event;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%client}}".
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property string $reset_token
 * @property string $email
 * @property integer $blocked
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Log[] $logs
 * @property OAuth[] $socials
 */
class Client extends \yii\db\ActiveRecord implements IdentityInterface
{
    const BLOCKED_NO = 0;
    const BLOCKED_YES = 1;

    const SCENARIO_CREATE = 'create';

    /**
     * @var null
     */
    public $pwd = null;

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => TimestampBehavior::className(),
            'HashBehavior' => [
                'class' => HashBehavior::className(),
                'attribute' => 'password',
            ],
            'AuthKeyGenerateRandomStringBehavior' => [
                'class' => GenerateRandomStringBehavior::className(),
                'attribute' => 'auth_key',
                'enabled' => function (Event $event) {

                    $clone = clone $event->sender;
                    $clone->trigger($clone::EVENT_BEFORE_INSERT);

                    return $clone->getDirtyAttributes(['password']) ? true : false;
                },
            ],
            'AccessTokenGenerateRandomStringBehavior' => [
                'class' => GenerateRandomStringBehavior::className(),
                'attribute' => 'access_token',
                'stringLength' => 128,
                'enabled' => function (Event $event) {

                    $clone = clone $event->sender;
                    $clone->trigger($clone::EVENT_BEFORE_INSERT);

                    return $clone->getDirtyAttributes(['password']) ? true : false;
                },
            ],
            'ResetTokenGenerateRandomStringBehavior' => [
                'class' => GenerateRandomStringBehavior::className(),
                'attribute' => 'reset_token',
                'stringLength' => 128,
                'enabled' => function (Event $event) {

                    $clone = clone $event->sender;
                    $clone->trigger($clone::EVENT_BEFORE_INSERT);

                    return $clone->getDirtyAttributes(['password']) ? true : false;
                },
            ],
            'EventBehavior' => [
                'class' => EventBehavior::className(),
                'events' => [
                    self::EVENT_AFTER_VALIDATE => [$this, 'savePassword'],
                    self::EVENT_AFTER_INSERT => [self::className(), 'send'],
                ],
            ],
            'TagDependencyBehavior' => [
                'class' => TagDependencyBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%client}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blocked'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['login'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['auth_key', 'email'], 'string', 'max' => 64],
            [['access_token', 'reset_token'], 'string', 'max' => 128],
            [['login', 'email'], 'unique'],
            [['login', 'email'], 'required'],
            [['email'], 'email'],
            [['auth_key'], 'unique'],
            [['access_token'], 'unique'],
            [['reset_token'], 'unique'],
            [['password'], 'required', 'on' => [self::SCENARIO_CREATE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'auth_key' => 'Ключ авторизации',
            'access_token' => 'Токен доступа',
            'reset_token' => 'Маркер сброса токена',
            'email' => 'Электронная почта',
            'blocked' => 'Заблокирован',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * @return array
     */
    public static function getBlockedList()
    {
        return [
            self::BLOCKED_NO => 'Нет',
            self::BLOCKED_YES => 'Да',
        ];
    }

    /**
     * @return mixed
     */
    public function getBlocked()
    {
        return ArrayHelper::getValue(self::getBlockedList(), $this->blocked);
    }

    /**
     * Сохраняем пароль для отправки по почте методом self::send()
     */
    public function savePassword()
    {
        $this->pwd = $this->password;
    }

    /**
     * @param yii\base\Event $event
     *
     * @return boolean
     */
    public static function send($event)
    {
        return Yii::$app
            ->getMailer()
            ->compose('@app/modules/cabinet/mail/register.php', [
                'model' => $event->sender,
            ])
            ->setSubject('Регистрация в Личном кабинете')
            ->setFrom(Yii::$app->params['email'])
            ->setTo($event->sender->email)
            ->send();
    }

    /**
     * @param string $password
     *
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /**
     * @param int|string $id
     *
     * @return IdentityInterface|static
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'blocked' => self::BLOCKED_NO]);
    }

    /**
     * @param mixed $token
     * @param null $type
     *
     * @return IdentityInterface|static
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token, 'blocked' => self::BLOCKED_NO]);
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $auth_key
     *
     * @return bool
     */
    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocials()
    {
        return $this->hasMany(OAuth::className(), ['client_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ClientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientQuery(get_called_class());
    }
}
