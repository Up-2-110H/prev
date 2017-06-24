<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 23.06.17
 * Time: 15:00
 */

namespace app\modules\cabinet\services;

use app\modules\cabinet\form\ConfirmForm;
use app\modules\cabinet\form\ResetForm;
use Yii;

/**
 * Class ResetPasswordService
 *
 * @package app\modules\cabinet\services
 */
class ResetPasswordService
{
    /**
     * @param ConfirmForm $form
     *
     * @return bool
     */
    public function confirm(ConfirmForm $form)
    {
        if ($result = $form->validate()) {
            $result = Yii::$app
                ->getMailer()
                ->compose('@app/modules/cabinet/mail/confirm.php', [
                    'model' => $form->findByConfirm(),
                ])
                ->setSubject('Изменение пароля в Личном кабинете')
                ->setFrom(Yii::$app->params['email'])
                ->setTo($form->email)
                ->send();
        }

        return $result;
    }

    /**
     * @param ResetForm $form
     *
     * @return bool
     */
    public function reset(ResetForm $form)
    {
        if ($result = $form->validate()) {
            $model = $form->findByReset();
            $password = $form->password;

            $model->setAttribute('password', Yii::$app->getSecurity()->generatePasswordHash($password));
            $model->setAttribute('auth_key', Yii::$app->getSecurity()->generateRandomString(64));
            $model->setAttribute('access_token', Yii::$app->getSecurity()->generateRandomString(128));
            $model->setAttribute('reset_token', Yii::$app->getSecurity()->generateRandomString(128));

            $result = $model->save();
        }

        return $result;
    }
}
