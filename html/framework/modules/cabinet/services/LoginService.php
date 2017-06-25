<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.06.17
 * Time: 0:32
 */

namespace app\modules\cabinet\services;

use app\modules\cabinet\form\LoginForm;
use Yii;

/**
 * Class LoginService
 *
 * @package app\modules\cabinet\services
 */
class LoginService
{
    /**
     * @param LoginForm $form
     *
     * @return bool
     */
    public function login(LoginForm $form)
    {
        if ($result = $form->validate()) {
            $result = Yii::$app->getUser()->login($form->findByLogin());
        }

        return $result;
    }
}
