<?php

namespace app\modules\cabinet\models;

use app\behaviors\TagDependencyBehavior;
use app\behaviors\TimestampBehavior;
use app\core\validators\PasswordValidator;
use app\interfaces\BlockedInterface;
use app\modules\cabinet\components\EmailVerifyInterface;
use app\modules\cabinet\components\EmailVerifyTrait;
use app\traits\BlockedTrait;
use Yii;
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
 * @property integer $email_verify
 * @property integer $blocked
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Log[] $logs
 * @property OAuth[] $socials
 */
class Client extends \yii\db\ActiveRecord implements IdentityInterface, BlockedInterface, EmailVerifyInterface
{
    use BlockedTrait;
    use EmailVerifyTrait;

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
            [['email_verify', 'blocked'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['login'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['password'], PasswordValidator::className()],
            [['auth_key', 'email'], 'string', 'max' => 64],
            [['access_token', 'reset_token'], 'string', 'max' => 128],
            [['login', 'email'], 'unique'],
            [['email'], 'email'],
            [['auth_key', 'access_token', 'reset_token'], 'unique'],
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
            'email_verify' => 'Электронная почта подтверждена',
            'blocked' => 'Заблокирован',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
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
