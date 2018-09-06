<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model tina\news\models\News */
/** @var $configs \krok\configure\ConfigurableInterface */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['url' => ['/news'], 'label' => 'Новости'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?php if ($model->getSrc()) : ?>
                <?= Html::img($model->getPreview()) ?>
            <?php endif ?>

            <?php if ($model->directory) : ?>
                <p>
                    Категории контента: <?= $model->directory->title ?>
                </p>
            <?php endif; ?>

            <div class="h2">
                <?= $model->title ?>
            </div>

            <div>
                <?= Yii::$app->getFormatter()->asDate($model->date); ?>
            </div>

            <div>
                <?= $model->announce ?>
            </div>

            <div>
                <?= $model->text ?>
            </div>

            <p>
                Дата добавления: <?= Yii::$app->getFormatter()->asDatetime($model->createdAt) ?>
            </p>

            <p>
                Дата последнего редактирования: <?= Yii::$app->getFormatter()->asDatetime($model->updatedAt) ?>
            </p>

        </div>
    </div>
</div>
