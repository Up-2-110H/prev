<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.11.18
 * Time: 16:07
 */

use krok\survey\widgets\frontend\SurveyWidget;

/** @var $this \yii\web\View */
/** @var $model \krok\survey\models\Survey */

$this->title = 'Опросы';
?>
<div>
    <?php if ($model) : ?>
        <p>
            <?= SurveyWidget::widget([
                'model' => $model,
            ]) ?>
        </p>
    <?php endif; ?>
</div>
