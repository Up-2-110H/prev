<?php

use krok\editor\EditorWidget;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model krok\content\models\Content */
?>

<?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'text')->widget(EditorWidget::class) ?>

<?= $form->field($model, 'layout')->dropDownList($model::getLayouts()) ?>

<?= $form->field($model, 'view')->dropDownList($model::getViews()) ?>

<?= $form->field($model, 'hidden')->dropDownList($model::getHiddenList()) ?>
