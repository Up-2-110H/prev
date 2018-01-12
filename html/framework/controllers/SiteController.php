<?php

namespace app\controllers;

use yii\base\DynamicModel;
use yii\data\Pagination;
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
    public $layout = '//common';

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string
     */
    public function actionExample()
    {
        $pagination = new Pagination([
            'totalCount' => 1000,
        ]);

        $breadcrumbs = [
            [
                'label' => 'Промежуточная',
                'url' => ['/'],
            ],
            [
                'label' => 'Активная',
            ],
        ];

        $model = new DynamicModel([
            'name' => 'Александр',
            'email' => null,
            'sex' => 1,
            'isHidden' => 0,
        ]);
        $model
            ->addRule(['name'], 'string')
            ->addRule(['email'], 'email')
            ->addRule(['sex', 'isHidden'], 'integer')
            ->addRule(['name', 'email'], 'required')
            ->validate();

        return $this->render('example', [
            'pagination' => $pagination,
            'breadcrumbs' => $breadcrumbs,
            'model' => $model,
        ]);
    }
}
