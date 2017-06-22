<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 03.04.16
 * Time: 15:25
 */

namespace app\modules\cabinet\form;

use app\modules\cabinet\components\ResetInterface;
use app\modules\cabinet\models\Client;
use yii\base\Model;

/**
 * Class Reset
 *
 * @package app\modules\cabinet\form
 */
class Reset extends Model implements ResetInterface
{
    /**
     * @var null
     */
    public $password = null;

    /**
     * @var null
     */
    public $token = null;

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
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['password'], 'required'],
            [['token'], 'string', 'max' => 128],
            [['token'], 'required'],
            ['password', 'authorization'],
            ['verifyCode', 'captcha', 'captchaAction' => '/cabinet/login/captcha'],
        ];
    }

    public function authorization()
    {
        if (!$this->hasErrors()) {
            if (!$this->findByReset()) {
                $this->addError('password', 'Неправильный маркер сброса');
            }
        }
    }

    /**
     * @return Client
     */
    public function findByReset()
    {
        if ($this->client === null) {
            $this->client = Client::findOne(['reset_token' => $this->token, 'blocked' => Client::BLOCKED_NO]);
        }

        return $this->client;
    }
}
