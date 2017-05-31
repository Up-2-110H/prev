<?php

namespace app\modules\auth\models;

use Yii;

/**
 * Class Login
 *
 * @package app\modules\auth\models
 */
class Login extends Auth
{
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
            [['login'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['login', 'password'], 'required'],
            ['password', 'authorization'],
            [
                'verifyCode',
                'captcha',
                'captchaAction' => '/cp/auth/default/captcha',
            ],
        ];
    }

    public function authorization()
    {
        if (!$this->hasErrors()) {
            if (!$this->getAuth() || !$this->getAuth()->validatePassword($this->password)) {
                $this->addError('Неправильное имя пользователя или пароль');
            }
        }
    }

    /**
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->getUser()->login($this->getAuth());
        } else {
            return false;
        }
    }

    /**
     * @return Auth
     */
    public function getAuth()
    {
        static $auth = null;

        if ($auth === null) {
            $auth = Auth::findOne(['login' => $this->login, 'blocked' => Auth::BLOCKED_NO]);
        }

        return $auth;
    }
}
