<?php

namespace krok\auth\controllers\backend;

use krok\system\components\backend\Controller;

/**
 * Class SocialController
 *
 * @package krok\auth\controllers\backend
 */
class SocialController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
