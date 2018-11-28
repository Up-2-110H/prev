<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.11.18
 * Time: 19:32
 */

use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model \krok\survey\models\Question */
?>
<div>
    <?= Html::input('number', 'answers[' . $model->id . '][]') ?>
</div>
