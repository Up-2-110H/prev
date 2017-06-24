<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 24.06.17
 * Time: 11:51
 */

namespace app\modules\cabinet\services;

use app\modules\cabinet\form\RegistrationForm;
use Yii;
use yii\db\ActiveRecordInterface;

/**
 * Class RegistrationService
 *
 * @package app\modules\cabinet\services
 */
class RegistrationService
{
    /**
     * @param RegistrationForm $form
     * @param ActiveRecordInterface $model
     *
     * @return bool
     */
    public function registration(RegistrationForm $form, ActiveRecordInterface $model)
    {
        if ($result = $form->validate()) {
            $login = $form->login;
            $password = $form->password;

            $model->setAttribute('login', $login);
            $model->setAttribute('password', Yii::$app->getSecurity()->generatePasswordHash($password));
            $model->setAttribute('auth_key', Yii::$app->getSecurity()->generateRandomString(64));
            $model->setAttribute('access_token', Yii::$app->getSecurity()->generateRandomString(128));
            $model->setAttribute('reset_token', Yii::$app->getSecurity()->generateRandomString(128));

            $result = $model->save();
        }

        return $result;
    }
}
