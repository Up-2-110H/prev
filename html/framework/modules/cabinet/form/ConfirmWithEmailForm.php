<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.06.17
 * Time: 9:26
 */

namespace app\modules\cabinet\form;

use app\modules\cabinet\models\Client;
use yii\base\Model;

/**
 * Class ConfirmWithEmailForm
 *
 * @package app\modules\cabinet\form
 */
class ConfirmWithEmailForm extends Model
{
    /**
     * @var null
     */
    public $email = null;

    /**
     * @var null
     */
    public $token = null;

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
            [['token'], 'string', 'max' => 128],
            [['email', 'token'], 'required'],
            [['email'], 'email'],
            ['email', 'authorization'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Электронная почта',
            'access_token' => 'Токен доступа',
        ];
    }

    public function authorization()
    {
        if (!$this->hasErrors()) {
            if (!$this->findByEmail() || !$this->validationToken()) {
                $this->addError('email', 'Неправильный адрес электронной почты');
            }
        }
    }

    /**
     * @return Client
     */
    public function findByEmail()
    {
        if ($this->client === null) {
            $this->client = Client::findOne([
                'email' => $this->email,
                'email_verify' => Client::EMAIL_VERIFY_NO,
                'blocked' => Client::BLOCKED_NO,
            ]);
        }

        return $this->client;
    }

    /**
     * @return bool
     */
    public function validationToken()
    {
        return $this->client->access_token == $this->token;
    }
}
