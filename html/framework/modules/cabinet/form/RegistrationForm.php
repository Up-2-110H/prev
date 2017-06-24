<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 24.06.17
 * Time: 11:43
 */

namespace app\modules\cabinet\form;

use app\modules\cabinet\models\Client;
use yii\base\Model;

/**
 * Class RegistrationForm
 *
 * @package app\modules\cabinet\form
 */
class RegistrationForm extends Model
{
    /**
     * @var null
     */
    public $login = null;

    /**
     * @var null
     */
    public $password = null;

    /**
     * @var null
     */
    public $verifyCode = null;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['login'], 'string', 'max' => 64],
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['login', 'password'], 'required'],
            ['login', 'unique', 'targetClass' => Client::className()],
            ['verifyCode', 'captcha', 'captchaAction' => '/cabinet/default/captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }
}
