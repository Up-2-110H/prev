<?php

namespace krok\cabinet\controllers\frontend;

use krok\system\components\frontend\Controller;
use Yii;

/**
 * Class DefaultController
 *
 * @package krok\cabinet\controllers\frontend
 */
class DefaultController extends Controller
{
    /**
     * @var string
     */
    public $layout = '//common';

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = Yii::$app->getUser()->getIdentity();

        return $this->render('index', ['model' => $model]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->getUser()->logout(false);

        return $this->goHome();
    }
}
