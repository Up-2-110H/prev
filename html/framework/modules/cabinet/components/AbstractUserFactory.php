<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 23.06.17
 * Time: 15:07
 */

namespace app\modules\cabinet\components;

use app\modules\cabinet\form\ConfirmForm;
use app\modules\cabinet\form\CreateForm;
use app\modules\cabinet\form\DeleteForm;
use app\modules\cabinet\form\LoginForm;
use app\modules\cabinet\form\LoginWithEmailForm;
use app\modules\cabinet\form\RegistrationForm;
use app\modules\cabinet\form\RegistrationWithEmailForm;
use app\modules\cabinet\form\ResetForm;
use app\modules\cabinet\form\UpdateForm;
use app\modules\cabinet\form\ViewForm;
use app\modules\cabinet\models\Client;
use app\modules\cabinet\models\ClientSearch;
use app\modules\cabinet\models\Log;
use app\modules\cabinet\models\LogSearch;
use app\modules\cabinet\services\LoginService;
use app\modules\cabinet\services\LoginWithEmailService;
use app\modules\cabinet\services\RegistrationService;
use app\modules\cabinet\services\RegistrationWithEmailService;
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
            case 'RegistrationWithEmail':
                return Yii::createObject(array_merge(['class' => RegistrationWithEmailService::class], $configuration));
                break;
            case 'Login':
                return Yii::createObject(array_merge(['class' => LoginService::class], $configuration));
                break;
            case 'LoginWithEmail':
                return Yii::createObject(array_merge(['class' => LoginWithEmailService::class], $configuration));
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
            case 'RegistrationWithEmail':
                return Yii::createObject(array_merge(['class' => RegistrationWithEmailForm::class], $configuration));
                break;
            case 'Login':
                return Yii::createObject(array_merge(['class' => LoginForm::class], $configuration));
                break;
            case 'LoginWithEmail':
                return Yii::createObject(array_merge(['class' => LoginWithEmailForm::class], $configuration));
                break;
            case 'Confirm':
                return Yii::createObject(array_merge(['class' => ConfirmForm::class], $configuration));
                break;
            case 'Reset':
                return Yii::createObject(array_merge(['class' => ResetForm::class], $configuration));
                break;
            case 'View':
                return Yii::createObject(array_merge(['class' => ViewForm::class], $configuration));
                break;
            case 'Create':
                return Yii::createObject(array_merge(['class' => CreateForm::class], $configuration));
                break;
            case 'Update':
                return Yii::createObject(array_merge(['class' => UpdateForm::class], $configuration));
                break;
            case 'Delete':
                return Yii::createObject(array_merge(['class' => DeleteForm::class], $configuration));
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
            case 'Client':
                return Yii::createObject(array_merge(['class' => Client::class], $configuration));
                break;
            case 'ClientSearch':
                return Yii::createObject(array_merge(['class' => ClientSearch::class], $configuration));
                break;
            case 'Log':
                return Yii::createObject(array_merge(['class' => Log::class], $configuration));
                break;
            case 'LogSearch':
                return Yii::createObject(array_merge(['class' => LogSearch::class], $configuration));
                break;
            default:
                throw new UnknownClassException();
        }
    }
}
