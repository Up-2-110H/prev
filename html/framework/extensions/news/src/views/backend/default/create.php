<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model krok\news\models\News */
/* @var $group array */

$this->title = Yii::t('system', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-content">

        <?php $form = ActiveForm::begin(); ?>

        <?= $this->render('_form', ['form' => $form, 'model' => $model, 'group' => $group]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('system', 'Create'),
                ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
