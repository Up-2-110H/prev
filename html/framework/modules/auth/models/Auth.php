<?php

namespace app\modules\auth\models;

use app\behaviors\GenerateRandomStringBehavior;
use app\behaviors\HashBehavior;
use app\behaviors\TimestampBehavior;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%auth}}".
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property string $email
 * @property integer $blocked
 * @property string $created_at
 * @property string $updated_at
 */
class Auth extends \yii\db\ActiveRecord implements IdentityInterface
{
    const BLOCKED_NO = 0;
    const BLOCKED_YES = 1;

    /**
     * @var null
     */
    public $password_repeat = null;

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
            'HashBehaviorPassword' => [
                'class' => HashBehavior::className(),
                'attribute' => 'password',
            ],
            'GenerateRandomStringBehaviorAuthKey' => [
                'class' => GenerateRandomStringBehavior::className(),
                'attribute' => 'auth_key',
                'stringLength' => 64,
            ],
            'GenerateRandomStringBehaviorAccessToken' => [
                'class' => GenerateRandomStringBehavior::className(),
                'attribute' => 'access_token',
                'stringLength' => 128,
            ],
            'TimestampBehavior' => TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth}}';
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
            [['password', 'password_repeat'], 'string', 'max' => 512, 'min' => 8],
            [['auth_key', 'email'], 'string', 'max' => 64],
            [['access_token'], 'string', 'max' => 128],
            [['login'], 'unique'],
            [['login'], 'required'],
            [['email'], 'email'],
            [['password', 'password_repeat'], 'required', 'on' => ['create']],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
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
            'password_repeat' => 'Повторите пароль',
            'auth_key' => 'Ключ авторизации',
            'access_token' => 'Токен доступа',
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
     * @inheritdoc
     * @return AuthQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthQuery(get_called_class());
    }
}
