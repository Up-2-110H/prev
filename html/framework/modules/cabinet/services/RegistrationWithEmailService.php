<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.06.17
 * Time: 7:57
 */

namespace app\modules\cabinet\services;

use app\modules\cabinet\form\RegistrationWithEmailForm;
use Yii;
use yii\db\ActiveRecordInterface;

/**
 * Class RegistrationWithEmailService
 *
 * @package app\modules\cabinet\services
 */
class RegistrationWithEmailService
{
    /**
     * @param RegistrationWithEmailForm $form
     * @param ActiveRecordInterface $model
     *
     * @return bool
     */
    public function registration(RegistrationWithEmailForm $form, ActiveRecordInterface $model)
    {
        if ($result = $form->validate()) {
            $email = $form->email;
            $password = $form->password;

            $model->setAttribute('email', $email);
            $model->setAttribute('email_verify', $form::EMAIL_VERIFY_NO);
            $model->setAttribute('blocked', $form::BLOCKED_NO);
            $model->setAttribute('password', Yii::$app->getSecurity()->generatePasswordHash($password));
            $model->setAttribute('auth_key', Yii::$app->getSecurity()->generateRandomString(64));
            $model->setAttribute('access_token', Yii::$app->getSecurity()->generateRandomString(128));
            $model->setAttribute('reset_token', Yii::$app->getSecurity()->generateRandomString(128));

            $result = $model->save();
        }

        return $result;
    }
}
