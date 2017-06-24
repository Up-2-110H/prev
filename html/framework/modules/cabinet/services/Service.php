<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 23.06.17
 * Time: 17:43
 */

namespace app\modules\cabinet\services;

use app\modules\cabinet\form\LoginForm;
use Yii;

/**
 * Class Service
 *
 * @package app\modules\cabinet\services
 */
class Service
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
