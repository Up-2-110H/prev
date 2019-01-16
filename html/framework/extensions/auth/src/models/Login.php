<?php

namespace krok\auth\models;

use krok\auth\Configurable;
use krok\configure\ConfigureInterface;
use Yii;
use yii\base\Model;
use yii\di\Instance;

/**
 * Class Login
 *
 * @package krok\auth\models
 */
class Login extends Model
{
    /**
     * @var string
     */
    public $login;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $verifyCode;

    /**
     * @var null|Auth
     */
    protected $auth = null;

    /**
     * @var Configurable
     */
    protected $configurable;

    /**
     * Login constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->configurable = Instance::ensure(ConfigureInterface::class,
            ConfigureInterface::class)->get(Configurable::class);
    }

    /**
     * @return array
     */
    public function rules()
    {
        $rules = [
            [['login'], 'string', 'max' => 32, 'min' => 4],
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['login', 'password'], 'required'],
            ['password', 'authorization'],

        ];

        if ($this->configurable->useCaptcha) {
            $rules = array_merge($rules, [
                [
                    'verifyCode',
                    'captcha',
                    'captchaAction' => '/auth/default/captcha',
                ],
            ]);
        }

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'verifyCode' => 'Проверочный код',
        ];
    }

    public function authorization()
    {
        if (!$this->hasErrors()) {
            if (!$this->getAuth() || !$this->getAuth()->validatePassword($this->password)) {
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
        if ($this->auth === null) {
            $this->auth = Auth::findOne(['login' => $this->login, 'blocked' => Auth::BLOCKED_NO]);
        }

        return $this->auth;
    }
}
