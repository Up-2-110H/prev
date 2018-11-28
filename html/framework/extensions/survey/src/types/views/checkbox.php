<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.11.18
 * Time: 15:35
 */

use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model \krok\survey\models\Question */
?>
<div>
    <?php foreach ($model->answersRelation as $answer) : ?>
        <p>
            <?= Html::label($answer->title) ?>
            <?= Html::checkbox('answers[' . $model->id . '][' . $answer->id . ']', false) ?>
        </p>
    <?php endforeach; ?>
</div>
