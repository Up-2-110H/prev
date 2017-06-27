<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.06.17
 * Time: 8:46
 */

use app\widgets\alert\AlertWidget;
use yii\authclient\widgets\AuthChoice;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\form\LoginWithEmailForm */
/* @var $form ActiveForm */

$this->title = Html::encode('Авторизация');
?>
<div class="default-login-with-email">

    <?= AlertWidget::widget(); ?>

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
                                <?= $form->field($model, 'email')->textInput(
                                    ['autofocus' => true, 'placeholder' => $model->getAttributeLabel('email')]
                                ) ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'password')->passwordInput(
                                    ['placeholder' => $model->getAttributeLabel('password'), 'value' => '']
                                ) ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'verifyCode')->widget(
                                    Captcha::className(), [
                                    'captchaAction' => '/cabinet/default/captcha',
                                    'options' => [
                                        'class' => 'form-control',
                                        'placeholder' => $model->getAttributeLabel('verifyCode'),
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
                        'baseAuthUrl' => ['/cabinet/default/oauth'],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- default-login-with-email -->
