<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 03.04.16
 * Time: 15:25
 */

namespace app\modules\cabinet\models;

/**
 * Class Confirm
 *
 * @package app\modules\cabinet\models
 */
class Confirm extends Client
{
    /**
     * @var null
     */
    public $verifyCode = null;

    /**
     * @var Client
     */
    private $client = null;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['email'], 'string', 'max' => 64],
            [['email'], 'email'],
            [['email'], 'required'],
            ['email', 'valid'],
            ['verifyCode', 'captcha', 'captchaAction' => '/cabinet/login/captcha'],
        ];
    }

    public function valid()
    {
        if (!$this->hasErrors()) {
            if (!$this->getClient()) {
                $this->addError('email', 'Неправильный адрес электронной почты');
            }
        }
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        if ($this->client === null) {
            $this->client = Client::findOne(['email' => $this->email, 'blocked' => Client::BLOCKED_NO]);
        }

        return $this->client;
    }
}
