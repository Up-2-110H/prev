<?php

use yii\authclient\widgets\AuthChoice;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Login */
/* @var $form ActiveForm */

$this->title = 'Авторизация';
?>
<div class="default-login">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Пожалуйста авторизуйтесь</h3>
                    </div>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin([
                            'fieldConfig' => [
                                'template' => '{input}' . PHP_EOL . '{error}',
                            ],
                        ]); ?>
                        <fieldset>
                            <div class="form-group">
                                <?= $form->field($model, 'login')->textInput(
                                    ['autofocus' => true, 'placeholder' => 'Логин']
                                ) ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'password')->passwordInput(
                                    ['placeholder' => 'Пароль']
                                ) ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'verifyCode')->widget(
                                    Captcha::className(), [
                                    'captchaAction' => '/auth/default/captcha',
                                    'options' => [
                                        'class' => 'form-control',
                                        'placeholder' => 'Проверочный код',
                                    ],
                                ]) ?>
                            </div>
                            <?= Html::submitButton('Авторизация', ['class' => 'btn btn-lg btn-success btn-block']) ?>
                        </fieldset>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= AuthChoice::widget([
                        'autoRender' => true,
                        'baseAuthUrl' => ['/auth/default/oauth'],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- default-login -->
