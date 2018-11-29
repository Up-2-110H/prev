<?php

use krok\extend\widgets\sortable\SortableWidget;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $items \krok\survey\models\Question[] */
/* @var $types \krok\survey\types\Type[] */

$this->title = Yii::t('system', 'Question');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-content">

        <?php foreach ($types as $type) : ?>
            <div class="more" style="float: left;">
                <?= Html::a($type['label'], $type['url'], [
                    'class' => 'btn btn-success',
                ]) ?>
            </div>
        <?php endforeach; ?>

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
