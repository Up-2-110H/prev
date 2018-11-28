<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 12:42
 */

namespace krok\survey\controllers\backend;

use krok\extend\widgets\sortable\actions\UpdateAllAction;
use krok\survey\actions\backend\answer\CreateAction;
use krok\survey\actions\backend\answer\DeleteAction;
use krok\survey\actions\backend\answer\IndexAction;
use krok\survey\actions\backend\answer\UpdateAction;
use krok\survey\actions\backend\answer\ViewAction;
use krok\survey\models\Answer;
use krok\system\components\backend\Controller;
use Yii;
use yii\filters\VerbFilter;

/**
 * Class AnswerController
 *
 * @package krok\survey\controllers\backend
 */
class AnswerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class,
            ],
            'create' => [
                'class' => CreateAction::class,
            ],
            'view' => [
                'class' => ViewAction::class,
            ],
            'update' => [
                'class' => UpdateAction::class,
            ],
            'delete' => [
                'class' => DeleteAction::class,
            ],
            'update-all' => [
                'class' => UpdateAllAction::class,
                'model' => new Answer(),
                'items' => Yii::$app->getRequest()->post('item', []),
            ],
        ];
    }
}
