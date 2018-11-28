<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model krok\survey\models\Question */
/* @var $isAnswers bool */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Question'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-header">
        <p>
            <?= Html::a(Yii::t('system', 'Update'), ['update', 'id' => $model->id], [
                'class' => 'btn btn-primary',
            ]) ?>
            <?= Html::a(Yii::t('system', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('system', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <?php if ($isAnswers === true) : ?>
            <p>
                <?= Html::a('Ответы', ['answer/index', 'id' => $model->id], [
                    'class' => 'btn btn-success',
                ]) ?>
            </p>
        <?php endif; ?>
    </div>

    <div class="card-content">

        <?= DetailView::widget([
            'options' => ['class' => 'table'],
            'model' => $model,
            'attributes' => [
                'id',
                'title',
                'hint',
                'hidden:boolean',
                'createdAt:datetime',
                'updatedAt:datetime',
            ],
        ]) ?>

    </div>
</div>
