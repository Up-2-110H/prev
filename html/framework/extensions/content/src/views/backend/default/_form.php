<?php

use krok\editor\EditorWidget;
use krok\flatpickr\FlatpickrDatetimeWidget;
use krok\maxlength\MaxlengthWidget;
use krok\transliterate\widgets\TransliterateWidget;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model krok\content\models\Content */
?>

<?= $form->field($model, 'title')->widget(TransliterateWidget::class, [
    'url' => Url::to(['transliterate']),
    'destination' => '#' . Html::getInputId($model, 'alias'),
    'enabled' => $model->getIsNewRecord(),
])->widget(MaxlengthWidget::class)->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'text')->widget(EditorWidget::class) ?>

<?= $form->field($model, 'layout')->dropDownList($model::getLayouts()) ?>

<?= $form->field($model, 'view')->dropDownList($model::getViews()) ?>

<?= $form->field($model, 'createdAt')->widget(FlatpickrDatetimeWidget::class) ?>

<?= $form->field($model, 'updatedAt')->widget(FlatpickrDatetimeWidget::class) ?>

<?= $form->field($model, 'hidden')->dropDownList($model::getHiddenList()) ?>
