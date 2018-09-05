<?php

use krok\extend\widgets\alert\AlertWidget;
use yii\authclient\widgets\AuthChoice;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model krok\cabinet\models\Client */

$this->title = Html::encode('Личный кабинет');
?>
<?= AlertWidget::widget(); ?>
<p>
    <?= Html::a('Выход', ['logout'], ['class' => 'btn btn-danger']) ?>
</p>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= sprintf('Привязка аккаунта <b>%s</b> к социальным сетям', ArrayHelper::getValue($model, 'login')) ?>
    </div>
    <div class="panel-body">
        <?= AuthChoice::widget([
            'popupMode' => false,
            'autoRender' => true,
            'baseAuthUrl' => ['/cabinet/login/oauth'],
        ]) ?>
    </div>
</div>
<div class="default-index">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'login',
            'authKey',
            'accessToken',
            [
                'attribute' => 'blocked',
                'value' => $model->getBlocked(),
            ],
            'createdAt:datetime',
            'updatedAt:datetime',
        ],
    ]) ?>
</div>
