<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 03.04.16
 * Time: 15:25
 */

namespace app\modules\cabinet\models;

/**
 * Class Reset
 *
 * @package app\modules\cabinet\models
 */
class Reset extends Client
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
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['password'], 'required'],
            [['reset_token'], 'string', 'max' => 128],
            [['reset_token'], 'required'],
            ['password', 'authorization'],
            ['verifyCode', 'captcha', 'captchaAction' => '/cabinet/login/captcha'],
        ];
    }

    public function authorization()
    {
        if (!$this->hasErrors()) {
            if (!$this->getClient()) {
                $this->addError('password', 'Неправильный маркер сброса');
            }
        }
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        if ($this->client === null) {
            $this->client = Client::findOne(['reset_token' => $this->reset_token, 'blocked' => Client::BLOCKED_NO]);
        }

        return $this->client;
    }
}
