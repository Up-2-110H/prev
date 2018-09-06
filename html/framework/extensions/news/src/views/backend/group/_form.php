<?php

use krok\maxlength\MaxlengthWidget;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model krok\news\models\Group */
?>

<?= $form->field($model, 'title')->widget(
    MaxlengthWidget::class
)->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'hidden')->dropDownList($model::getHiddenList()) ?>
