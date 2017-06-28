<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.06.17
 * Time: 7:57
 */

namespace app\modules\cabinet\form;

use app\interfaces\BlockedAttributeInterface;
use app\modules\cabinet\components\EmailVerifyInterface;
use app\modules\cabinet\components\EmailVerifyTrait;
use app\modules\cabinet\models\Client;
use app\traits\BlockedAttributeTrait;
use yii\base\Model;

/**
 * Class RegistrationWithEmailForm
 *
 * @package app\modules\cabinet\form
 */
class RegistrationWithEmailForm extends Model implements BlockedAttributeInterface, EmailVerifyInterface
{
    use BlockedAttributeTrait;
    use EmailVerifyTrait;

    /**
     * @var null
     */
    public $email = null;

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
            [['email'], 'string', 'max' => 64],
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['email', 'password'], 'required'],
            [['email'], 'email'],
            ['email', 'unique', 'targetClass' => Client::className()],
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
            'password' => 'Пароль',
        ];
    }
}
