<?php

use krok\editor\EditorWidget;
use krok\flatpickr\FlatpickrDatetimeWidget;
use krok\flatpickr\FlatpickrDateWidget;
use krok\maxlength\MaxlengthWidget;
use tina\news\models\Group;
use tina\news\models\News;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model tina\news\models\News */
?>

<?= $form->field($model, 'title')->widget(
    MaxlengthWidget::class
)->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'groupIds')->dropDownList(Group::asDropDown(), [
    'multiple' => true,
]) ?>

<?= $form->field($model, 'date')->widget(FlatpickrDateWidget::class) ?>

<?= $form->field($model, 'src')->fileInput(['accept' => 'image/*']) ?>

<?= $form->field($model, 'announce')->widget(
    MaxlengthWidget::class
)->textarea(['maxlength' => true, 'rows' => 6]) ?>

<?= $form->field($model, 'text')->widget(EditorWidget::class) ?>

<?= $form->field($model, 'directoryId')->dropDownList($model::getDirectoryList()) ?>

<?= $form->field($model, 'createdAt')->widget(FlatpickrDatetimeWidget::class) ?>

<?= $form->field($model, 'updatedAt')->widget(FlatpickrDatetimeWidget::class) ?>

<?= $form->field($model, 'hidden')->dropDownList(News::getHiddenList()) ?>
