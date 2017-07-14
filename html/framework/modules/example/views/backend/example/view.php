<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\example\dto\backend\ViewDto */

$this->title = $model->getTitle();
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Example'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-header">
        <p>
            <?= Html::a(Yii::t('system', 'Update'), ['update', 'id' => $model->getId()], [
                'class' => 'btn btn-primary',
            ]) ?>
            <?= Html::a(Yii::t('system', 'Delete'), ['delete', 'id' => $model->getId()], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('system', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>

    <div class="card-content">

        <?= DetailView::widget([
            'options' => ['class' => 'table'],
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'id',
                    'value' => function (\app\modules\example\dto\backend\ViewDto $dto) {
                        return $dto->getId();
                    },
                ],
                [
                    'attribute' => 'title',
                    'value' => function (\app\modules\example\dto\backend\ViewDto $dto) {
                        return $dto->getTitle();
                    },
                ],
                [
                    'attribute' => 'hidden',
                    'value' => function (\app\modules\example\dto\backend\ViewDto $dto) {
                        return $dto->getHidden();
                    },
                    'format' => 'boolean',
                ],
                [
                    'attribute' => 'createdAt',
                    'value' => function (\app\modules\example\dto\backend\ViewDto $dto) {
                        return $dto->getCreatedAt();
                    },
                ],
                [
                    'attribute' => 'updatedAt',
                    'value' => function (\app\modules\example\dto\backend\ViewDto $dto) {
                        return $dto->getUpdatedAt();
                    },
                ],
            ],
        ]) ?>

    </div>
</div>
