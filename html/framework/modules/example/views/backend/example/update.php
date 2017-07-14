<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\example\forms\backend\UpdateForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('system', 'Update') . ' : ' . $model->getTitle();
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Example'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getTitle(), 'url' => ['view', 'id' => $model->getId()]];
$this->params['breadcrumbs'][] = Yii::t('system', 'Update');
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-content">

        <?php $form = ActiveForm::begin(); ?>

        <?= $this->render('_form', [
            'form' => $form,
            'model' => $model,
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('system', 'Update'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
