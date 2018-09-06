<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'separator' => '<br />',
    'itemView' => '_item',
]) ?>
