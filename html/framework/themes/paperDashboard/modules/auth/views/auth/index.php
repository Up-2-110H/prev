<?php

use app\themes\paperDashboard\widgets\grid\GridViewWidget;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auth\models\AuthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-header">
        <?= Html::a(Yii::t('cp', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="card-content table-responsive table-full-width">

        <?= GridViewWidget::widget([
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
                        /* @var \app\modules\auth\models\Auth $model */
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
                ['class' => 'app\themes\paperDashboard\widgets\grid\ActionColumnWidget'],
            ],
        ]); ?>

    </div>
</div>
