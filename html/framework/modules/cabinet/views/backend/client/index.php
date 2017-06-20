<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cabinet\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('system', 'Client');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-header">
        <p>
            <?= Html::a(Yii::t('system', 'Create'), ['create'], [
                'class' => 'btn btn-success',
            ]) ?>
        </p>
    </div>

    <div class="card-content">

        <?= GridView::widget([
            'tableOptions' => ['class' => 'table'],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'login',
                'email:email',
                [
                    'attribute' => 'blocked',
                    'filter' => $searchModel::getBlockedList(),
                    'value' => function ($model) {
                        /* @var $model \app\modules\cabinet\models\Client */
                        return $model->getBlocked();
                    },
                ],
                [
                    'class' => 'app\core\grid\DatePickerColumn',
                    'attribute' => 'created_at',
                ],
                [
                    'class' => 'app\core\grid\DatePickerColumn',
                    'attribute' => 'updated_at',
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete} {login-as}',
                    'buttons' => [
                        'login-as' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-log-in"></span>',
                                ['login-as', 'id' => $model->id], [
                                    'title' => 'Войти как',
                                ]
                            );
                        },
                    ],
                ],
            ],
        ]); ?>

    </div>
</div>
