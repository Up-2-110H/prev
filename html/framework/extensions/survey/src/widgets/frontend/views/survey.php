<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.11.18
 * Time: 15:09
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this \yii\web\View */
/** @var $model \krok\survey\models\Survey */
?>
<div>
    <?php $form = ActiveForm::begin(['action' => ['/survey/default/send', 'id' => $model->id], 'method' => 'post']) ?>

    <h1><?= $model->title ?></h1>

    <?php foreach ($model->questionsRelation as $question) : ?>

        <h2><?= $question->title ?></h2>
        <div><?= $question->createType()->getForm() ?></div>

    <?php endforeach; ?>

    <?= Html::submitButton('Отправить') ?>

    <?php ActiveForm::end() ?>
</div>
