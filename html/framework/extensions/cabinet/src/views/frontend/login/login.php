<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 04.02.16
 * Time: 0:12
 */

use yii\authclient\widgets\AuthChoice;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model krok\cabinet\models\Login */
/* @var $form ActiveForm */

$this->title = Html::encode('Авторизация');
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
                                <?= $form->field($model, 'login')->textInput([
                                    'autofocus' => true,
                                    'placeholder' => $model->getAttributeLabel('login'),
                                ]) ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'password')->passwordInput([
                                    'placeholder' => $model->getAttributeLabel('password'),
                                    'value' => false,
                                ]) ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                                    'captchaAction' => '/cabinet/login/captcha',
                                    'options' => [
                                        'class' => 'form-control',
                                        'placeholder' => $model->getAttributeLabel('captcha'),
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
                        'popupMode' => false,
                        'autoRender' => true,
                        'baseAuthUrl' => ['/cabinet/login/oauth'],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- default-login -->
