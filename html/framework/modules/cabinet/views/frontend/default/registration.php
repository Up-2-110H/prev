<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 24.06.17
 * Time: 11:45
 */

use app\widgets\alert\AlertWidget;
use yii\authclient\widgets\AuthChoice;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\form\RegistrationForm */
/* @var $form ActiveForm */

$this->title = Html::encode('Регистрация');
?>
<div class="default-registration">

    <?= AlertWidget::widget(); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $this->title ?></h3>
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
                                    ['autofocus' => true, 'placeholder' => $model->getAttributeLabel('login')]
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
                            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-lg btn-success btn-block']) ?>
                        </fieldset>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= AuthChoice::widget([
                        'popupMode' => false,
                        'autoRender' => true,
                        'baseAuthUrl' => ['/cabinet/default/oauth'],
                        'clientCollection' => 'cabinetClientCollection',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- default-registration -->
