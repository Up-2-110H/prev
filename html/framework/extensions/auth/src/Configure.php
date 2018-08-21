<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 09.08.18
 * Time: 14:55
 */

namespace krok\auth;

use krok\configure\ConfigurableInterface;
use krok\configure\types\DropDownType;
use Yii;
use yii\base\Model;

/**
 * Class Configure
 *
 * @package krok\auth
 */
class Configure extends Model implements ConfigurableInterface
{
    const SOCIAL_AUTHORIZATION_NO = 0;
    const SOCIAL_AUTHORIZATION_YES = 1;

    const USE_CAPTCHA_NO = 0;
    const USE_CAPTCHA_YES = 1;

    const AUTH_TIMEOUT = 1 * 60 * 60;

    /**
     * @var int
     */
    public $socialAuthorization = self::SOCIAL_AUTHORIZATION_YES;

    /**
     * @var int
     */
    public $useCaptcha = self::USE_CAPTCHA_YES;

    /**
     * @var int seconds
     */
    public $authTimeout = self::AUTH_TIMEOUT;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['socialAuthorization', 'useCaptcha'], 'integer'],
            [['authTimeout'], 'integer', 'min' => 1, 'max' => Yii::$app->getSession()->timeout / 60],
            [['socialAuthorization', 'useCaptcha', 'authTimeout'], 'required'],
            [
                ['authTimeout'],
                function ($attribute) {
                    $this->{$attribute} *= 60;
                },
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'socialAuthorization' => 'Вход через социальные сети',
            'useCaptcha' => 'Проверочный код',
            'authTimeout' => 'Время сессии',
        ];
    }

    /**
     * @return array
     */
    public function attributeHints()
    {
        return [
            'authTimeout' => 'Бездействие в минутах по истечению которых нужно авторизоваться повторно',
        ];
    }

    /**
     * @return string
     */
    public static function label(): string
    {
        return 'Настройки авторизации';
    }

    /**
     * @return array
     */
    public static function attributeTypes(): array
    {
        return [
            'socialAuthorization' => [
                'class' => DropDownType::class,
                'config' => [
                    'items' => static::getSocialAuthorizationList(),
                ],
            ],
            'useCaptcha' => [
                'class' => DropDownType::class,
                'config' => [
                    'items' => static::getUseCaptchaList(),
                ],
            ],
            'authTimeout' => [
                'class' => AuthTimeoutType::class,
            ],
        ];
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function populate(array $data): bool
    {
        if ($this->load($data)) {
            return $this->validate();
        }

        return false;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public static function getSocialAuthorizationList(): array
    {
        return [
            static::SOCIAL_AUTHORIZATION_NO => 'Нет',
            static::SOCIAL_AUTHORIZATION_YES => 'Да',
        ];
    }

    /**
     * @return array
     */
    public static function getUseCaptchaList(): array
    {
        return [
            static::USE_CAPTCHA_NO => 'Никогда не проверять',
            static::USE_CAPTCHA_YES => 'Проверять всегда',
        ];
    }
}
