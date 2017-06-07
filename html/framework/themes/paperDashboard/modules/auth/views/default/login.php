<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Login */
/* @var $form ActiveForm */

$this->title = 'Авторизация';
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
            <?php $form = ActiveForm::begin([
                'fieldConfig' => [
                    'template' => '{label}' . PHP_EOL . '{input}' . PHP_EOL . '{error}',
                ],
            ]); ?>
            <div class="card" data-background="color" data-color="blue">
                <div class="card-header">
                    <h3 class="card-title">Пожалуйста авторизуйтесь</h3>
                </div>
                <div class="card-content">
                    <div class="form-group">
                        <?= $form->field($model, 'login')->textInput(
                            ['class' => 'form-control input-no-border']
                        ) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'password')->passwordInput(
                            ['class' => 'form-control input-no-border']
                        ) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'verifyCode')->widget(
                            Captcha::className(), [
                            'captchaAction' => '/auth/default/captcha',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <?= Html::submitButton('Авторизация', ['class' => 'btn btn-fill btn-wd']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
