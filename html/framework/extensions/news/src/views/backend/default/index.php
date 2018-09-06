<?php

use krok\extend\grid\DatePickerColumn;
use krok\extend\grid\HiddenColumn;
use krok\news\column\GroupColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel krok\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('system', 'News');
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
                ['class' => 'yii\grid\ActionColumn'],
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                    'class' => GroupColumn::class,
                ],
                'title',
                [
                    'class' => DatePickerColumn::class,
                    'attribute' => 'date',
                ],
                [
                    'class' => HiddenColumn::class,
                    'attribute' => 'hidden',
                ],
                [
                    'class' => DatePickerColumn::class,
                    'attribute' => 'createdAt',
                ],
                [
                    'class' => DatePickerColumn::class,
                    'attribute' => 'updatedAt',
                ],
            ],
        ]); ?>

    </div>
</div>
