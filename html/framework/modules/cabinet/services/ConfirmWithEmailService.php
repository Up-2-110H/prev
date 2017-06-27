<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.06.17
 * Time: 9:40
 */

namespace app\modules\cabinet\services;

use app\modules\cabinet\form\ConfirmWithEmailForm;
use Yii;

/**
 * Class ConfirmWithEmailService
 *
 * @package app\modules\cabinet\services
 */
class ConfirmWithEmailService
{
    /**
     * @param ConfirmWithEmailForm $form
     *
     * @return bool
     */
    public function confirm(ConfirmWithEmailForm $form)
    {
        if ($result = $form->validate()) {
            $model = $form->findByEmail();

            $model->email_verify = $model::EMAIL_VERIFY_YES;
            $model->access_token = Yii::$app->getSecurity()->generateRandomString(128);

            $result = $model->save();
        }

        return $result;
    }
}
