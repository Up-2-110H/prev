<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Auth */

$this->title = $model->login;
$this->params['breadcrumbs'][] = ['label' => 'Авторизация', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp', 'Update'), ['update', 'id' => $model->id], [
            'class' => 'btn btn-primary',
        ]) ?>
        <?= Html::a(Yii::t('cp', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cp', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'login',
            'auth_key',
            'access_token',
            'email:email',
            [
                'attribute' => 'blocked',
                'value' => $model->getBlocked(),
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
