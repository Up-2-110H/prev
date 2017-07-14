<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\example\forms\backend\CreateForm|\app\modules\example\forms\backend\UpdateForm */
?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'hidden')->dropDownList($model::getHiddenList()) ?>
