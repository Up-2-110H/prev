<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Auth */

$this->title = Yii::t('cp', 'Create');
$this->params['breadcrumbs'][] = ['label' => 'Авторизация', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
