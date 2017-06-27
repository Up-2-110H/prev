<?php

use app\widgets\alert\AlertWidget;
use yii\authclient\widgets\AuthChoice;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\models\Client */

$this->title = Html::encode('Личный кабинет');
?>
<?= AlertWidget::widget(); ?>
<p>
    <?= Html::a('Выход', ['logout'], ['class' => 'btn btn-danger']) ?>
</p>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= sprintf('Привязка аккаунта <b>%s</b> к социальным сетям',
            ArrayHelper::getValue(Yii::$app->getUser()->getIdentity(), 'login')) ?>
    </div>
    <div class="panel-body">
        <?= AuthChoice::widget([
            'popupMode' => false,
            'autoRender' => true,
            'baseAuthUrl' => ['/cabinet/default/oauth'],
        ]) ?>
    </div>
</div>
<div class="client-index">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'login',
            'auth_key',
            'access_token',
            'reset_token',
            'email:email',
            [
                'attribute' => 'email_verify',
                'value' => $model->getEmailVerify(),
            ],
            [
                'attribute' => 'blocked',
                'value' => $model->getBlocked(),
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
</div>
