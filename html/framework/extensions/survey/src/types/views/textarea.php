<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.11.18
 * Time: 15:56
 */

use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model \krok\survey\models\Question */
?>
<div>
    <?= Html::textarea('answers[' . $model->id . '][]') ?>
</div>
