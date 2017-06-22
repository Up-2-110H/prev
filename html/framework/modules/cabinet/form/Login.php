<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 03.04.16
 * Time: 15:25
 */

namespace app\modules\cabinet\form;

use app\modules\cabinet\components\LoginInterface;
use app\modules\cabinet\models\Client;
use yii\base\Model;

/**
 * Class Login
 *
 * @package app\modules\cabinet\form
 */
class Login extends Model implements LoginInterface
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
     * @var Client
     */
    private $client = null;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['login'], 'string', 'max' => 64],
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['login', 'password'], 'required'],
            ['password', 'authorization'],
            ['verifyCode', 'captcha', 'captchaAction' => '/cabinet/login/captcha'],
        ];
    }

    public function authorization()
    {
        if (!$this->hasErrors()) {
            if (!$this->findByLogin() || !$this->findByLogin()->validatePassword($this->password)) {
                $this->addError('password', 'Неправильное имя пользователя или пароль');
            }
        }
    }

    /**
     * @return Client
     */
    public function findByLogin()
    {
        if ($this->client === null) {
            $this->client = Client::findOne(['login' => $this->login, 'blocked' => Client::BLOCKED_NO]);
        }

        return $this->client;
    }
}
