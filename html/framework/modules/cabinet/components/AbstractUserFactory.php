<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 23.06.17
 * Time: 15:07
 */

namespace app\modules\cabinet\components;

use app\modules\cabinet\form\ConfirmForm;
use app\modules\cabinet\form\LoginForm;
use app\modules\cabinet\form\RegistrationForm;
use app\modules\cabinet\form\ResetForm;
use app\modules\cabinet\models\Client;
use app\modules\cabinet\services\RegistrationService;
use app\modules\cabinet\services\ResetPasswordService;
use app\modules\cabinet\services\Service;
use Yii;
use yii\base\UnknownClassException;

/**
 * Class AbstractUserFactory
 *
 * @package app\modules\cabinet\components
 */
abstract class AbstractUserFactory
{
    /**
     * @param string $class
     * @param array $configuration
     *
     * @return object
     * @throws UnknownClassException
     */
    public function service($class, array $configuration = [])
    {
        switch ($class) {
            case 'Service':
                return Yii::createObject(array_merge(['class' => Service::class], $configuration));
                break;
            case 'Registration':
                return Yii::createObject(array_merge(['class' => RegistrationService::class], $configuration));
                break;
            case 'ResetPassword':
                return Yii::createObject(array_merge(['class' => ResetPasswordService::class], $configuration));
                break;
            default:
                throw new UnknownClassException();
        }
    }

    /**
     * @param string $class
     * @param array $configuration
     *
     * @return object
     * @throws UnknownClassException
     */
    public function form($class, array $configuration = [])
    {
        switch ($class) {
            case 'Registration':
                return Yii::createObject(array_merge(['class' => RegistrationForm::class], $configuration));
                break;
            case 'Login':
                return Yii::createObject(array_merge(['class' => LoginForm::class], $configuration));
                break;
            case 'Confirm':
                return Yii::createObject(array_merge(['class' => ConfirmForm::class], $configuration));
                break;
            case 'Reset':
                return Yii::createObject(array_merge(['class' => ResetForm::class], $configuration));
                break;
            default:
                throw new UnknownClassException();
        }
    }

    /**
     * @param string $class
     * @param array $configuration
     *
     * @return object
     * @throws UnknownClassException
     */
    public function model($class, array $configuration = [])
    {
        switch ($class) {
            case 'User':
                return Yii::createObject(array_merge(['class' => Client::class], $configuration));
                break;
            default:
                throw new UnknownClassException();
        }
    }
}
