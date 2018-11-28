<?php

use krok\extend\widgets\sortable\SortableWidget;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $items \krok\survey\models\Answer[] */

$this->title = Yii::t('system', 'Answer');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-header">
        <p>
            <?= Html::a(Yii::t('system', 'Create'), ['create'] + Yii::$app->getRequest()->getQueryParams(), [
                'class' => 'btn btn-success',
            ]) ?>
        </p>
    </div>

    <div class="card-content">

        <?= SortableWidget::widget([
            'items' => $items,
            'attributeContent' => 'title',
            'clientEvents' => [
                'update' => 'function (event, ui) { jQuery(this).sortableWidget({url: \'' . Url::to(['update-all']) . '\'}) }',
            ],
        ]) ?>

    </div>
</div>
