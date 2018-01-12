<?php

use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $pagination \yii\data\Pagination */
/* @var $breadcrumbs array */
/* @var $model \yii\base\DynamicModel */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <h2>Пагинация</h2>
    <div>
        <?= LinkPager::widget([
            'pagination' => $pagination,
        ]) ?>
    </div>

    <h2>Хлебные крошки</h2>
    <div>
        <?= Breadcrumbs::widget([
            'links' => $breadcrumbs,
        ]) ?>
    </div>

    <h2>Форма</h2>
    <div>
        <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'sex')->radioList([0 => 'Woman', 1 => 'Men']) ?>

        <?= $form->field($model, 'isHidden')->checkbox() ?>

        <?php ActiveForm::end(); ?>
    </div>

</div>
