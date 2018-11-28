<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model krok\survey\models\Question */
?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'hint')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'hidden')->dropDownList($model::getHiddenList()) ?>
