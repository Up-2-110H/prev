<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 03.04.16
 * Time: 15:25
 */

namespace krok\cabinet\models;

use Yii;

/**
 * Class Login
 *
 * @package krok\cabinet\models
 */
class Login extends Client
{
    /**
     * @var string
     */
    public $verifyCode;

    /**
     * @var Client
     */
    private $client;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['login'], 'string', 'max' => 64, 'min' => 4],
            [['password'], 'string', 'max' => 60, 'min' => 8],
            [['login', 'password'], 'required'],
            [['password'], 'authorization'],
            [['verifyCode'], 'captcha', 'captchaAction' => '/cabinet/login/captcha'],
        ];
    }

    public function authorization()
    {
        if (!$this->hasErrors()) {
            if ($this->getClient() === null || !$this->getClient()->validatePassword($this->password)) {
                $this->addError('password', 'Неправильное имя пользователя или пароль');
            }
        }
    }

    /**
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->getUser()->login($this->getClient());
        } else {
            return false;
        }
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        if ($this->client === null) {
            $this->client = static::findOne(['login' => $this->login, 'blocked' => self::BLOCKED_NO]);
        }

        return $this->client;
    }
}
