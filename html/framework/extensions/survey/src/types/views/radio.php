<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.11.18
 * Time: 18:56
 */

use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model \krok\survey\models\Question */
?>
<div>
    <?php foreach ($model->answersRelation as $answer) : ?>
        <p>
            <?= Html::label($answer->title) ?>
            <?= Html::radio('answers[' . $model->id . '][]', false, [
                'value' => $answer->id,
            ]) ?>
        </p>
    <?php endforeach; ?>
</div>
