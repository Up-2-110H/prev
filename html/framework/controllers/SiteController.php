<?php

namespace app\controllers;

use yii\web\Controller;

/**
 * Class SiteController
 *
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * @var string
     */
    public $layout = '//index';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
