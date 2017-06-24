<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 03.04.16
 * Time: 15:25
 */

namespace app\modules\cabinet\form;

use app\modules\cabinet\models\Client;
use yii\base\Model;

/**
 * Class ConfirmForm
 *
 * @package app\modules\cabinet\form
 */
class ConfirmForm extends Model
{
    /**
     * @var null
     */
    public $email = null;

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
    public function rules()
    {
        return [
            [['email'], 'string', 'max' => 64],
            [['email'], 'email'],
            [['email'], 'required'],
            ['email', 'valid'],
            ['verifyCode', 'captcha', 'captchaAction' => '/cabinet/default/captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Электронная почта',
        ];
    }

    public function valid()
    {
        if (!$this->hasErrors()) {
            if (!$this->findByConfirm()) {
                $this->addError('email', 'Неправильный адрес электронной почты');
            }
        }
    }

    /**
     * @return Client
     */
    public function findByConfirm()
    {
        if ($this->client === null) {
            $this->client = Client::findOne(['email' => $this->email, 'blocked' => Client::BLOCKED_NO]);
        }

        return $this->client;
    }
}
