<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $clients [] */
/* @var $searchModel \krok\cabinet\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('system', 'Log');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-content">

        <?= GridView::widget([
            'tableOptions' => ['class' => 'table'],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                    'class' => \krok\extend\grid\ActiveColumn::class,
                    'attribute' => 'clientId',
                    'filter' => $clients,
                    'value' => function (\krok\cabinet\models\Log $model) {
                        return ArrayHelper::getValue($model->clientRelation, 'login');
                    },
                    'action' => '/cabinet/client/view',
                ],
                [
                    'attribute' => 'status',
                    'filter' => $searchModel::getStatusList(),
                    'value' => function (\krok\cabinet\models\Log $model) {
                        return $model->getStatus();
                    },
                ],
                [
                    'attribute' => 'ip',
                    'value' => function (\krok\cabinet\models\Log $model) {
                        return long2ip($model->ip);
                    },
                ],
                [
                    'class' => \krok\extend\grid\DatePickerColumn::class,
                    'attributeFilter' => 'createdAtFrom',
                    'attribute' => 'createdAt',
                ],
                [
                    'class' => \krok\extend\grid\DatePickerColumn::class,
                    'attributeFilter' => 'createdAtTo',
                    'attribute' => 'createdAt',
                ],
            ],
        ]); ?>

    </div>
</div>
