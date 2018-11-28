<?php

namespace krok\survey\controllers\backend;

use krok\extend\widgets\sortable\actions\UpdateAllAction;
use krok\survey\actions\backend\question\CreateAction;
use krok\survey\actions\backend\question\DeleteAction;
use krok\survey\actions\backend\question\IndexAction;
use krok\survey\actions\backend\question\UpdateAction;
use krok\survey\actions\backend\question\ViewAction;
use krok\survey\models\Question;
use krok\survey\types\CheckboxType;
use krok\survey\types\NumberType;
use krok\survey\types\RadioType;
use krok\survey\types\SelectMultipleType;
use krok\survey\types\SelectType;
use krok\survey\types\TextareaType;
use krok\system\components\backend\Controller;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
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
                'types' => [
                    [
                        'label' => 'Текстовой ответ',
                        'url' => Url::to(['textarea'] + Yii::$app->getRequest()->getQueryParams()),
                    ],
                    [
                        'label' => 'Цифровой ответ',
                        'url' => Url::to(['numeric'] + Yii::$app->getRequest()->getQueryParams()),
                    ],
                    [
                        'label' => 'Одиночный ответ',
                        'url' => Url::to(['radio'] + Yii::$app->getRequest()->getQueryParams()),
                    ],
                    [
                        'label' => 'Ответ с несколькими вариантами',
                        'url' => Url::to(['checkbox'] + Yii::$app->getRequest()->getQueryParams()),
                    ],
                    [
                        'label' => 'Селектор с одиночным ответом',
                        'url' => Url::to(['select'] + Yii::$app->getRequest()->getQueryParams()),
                    ],
                    [
                        'label' => 'Селектор с несколькими вариантами',
                        'url' => Url::to(['select-multiple'] + Yii::$app->getRequest()->getQueryParams()),
                    ],
                ],
            ],
            'textarea' => [
                'class' => CreateAction::class,
                'model' => new Question(['type' => TextareaType::class]),
            ],
            'numeric' => [
                'class' => CreateAction::class,
                'model' => new Question(['type' => NumberType::class]),
            ],
            'radio' => [
                'class' => CreateAction::class,
                'model' => new Question(['type' => RadioType::class]),
            ],
            'checkbox' => [
                'class' => CreateAction::class,
                'model' => new Question(['type' => CheckboxType::class]),
            ],
            'select' => [
                'class' => CreateAction::class,
                'model' => new Question(['type' => SelectType::class]),
            ],
            'select-multiple' => [
                'class' => CreateAction::class,
                'model' => new Question(['type' => SelectMultipleType::class]),
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
                'model' => new Question(),
                'items' => Yii::$app->getRequest()->post('item', []),
            ],
        ];
    }
}
