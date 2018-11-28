<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.11.18
 * Time: 19:00
 */

use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model \krok\survey\models\Question */
/** @var $items array */
?>
<div>
    <?= Html::dropDownList('answers[' . $model->id . '][]', null, $items, [
        'multiple' => true,
    ]) ?>
</div>
