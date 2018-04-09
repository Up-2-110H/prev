<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 19.07.17
 * Time: 23:54
 */

namespace app\modules\auth\models;

use krok\extend\behaviors\GenerateRandomStringBehavior;
use krok\extend\behaviors\HashBehavior;
use krok\extend\behaviors\TimestampBehavior;
use Yii;

/**
 * Class Profile
 *
 * @package app\modules\auth\models
 */
class Profile extends Auth
{
    /**
     * @var string
     */
    public $passwordNew;

    /**
     * @var null|Auth
     */
    protected $auth = null;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'HashBehaviorPassword' => [
                'class' => HashBehavior::className(),
                'attribute' => 'password',
                'scenarios' => [
                    self::SCENARIO_DEFAULT,
                ],
                'value' => function () {
                    return Yii::$app->getSecurity()->generatePasswordHash($this->passwordNew);
                },
            ],
            'GenerateRandomStringBehaviorAuthKey' => [
                'class' => GenerateRandomStringBehavior::className(),
                'attribute' => 'authKey',
                'scenarios' => [
                    self::SCENARIO_DEFAULT,
                ],
                'stringLength' => 128,
            ],
            'GenerateRandomStringBehaviorAccessToken' => [
                'class' => GenerateRandomStringBehavior::className(),
                'attribute' => 'accessToken',
                'scenarios' => [
                    self::SCENARIO_DEFAULT,
                ],
                'stringLength' => 128,
            ],
            'TimestampBehavior' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['password', 'passwordNew'], 'string', 'max' => 512, 'min' => 8],
            [['password', 'passwordNew'], 'required'],
            [['password'], 'authorization'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'password' => 'Старый пароль',
            'passwordNew' => 'Новый пароль',
        ];
    }

    public function authorization()
    {
        if (!$this->hasErrors()) {
            if (!$this->getAuth() || !Yii::$app->getSecurity()->validatePassword($this->password,
                    $this->getAuth()->password)
            ) {
                $this->addError('password', 'Неправильный пароль');
            }
        }
    }

    /**
     * @return Auth
     */
    public function getAuth()
    {
        if ($this->auth === null) {
            $this->auth = Yii::$app->getUser()->getIdentity();
        }

        return $this->auth;
    }
}
