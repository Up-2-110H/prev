<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 02.12.16
 * Time: 12:44
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\cabinet\form\ConfirmForm */

use app\widgets\alert\AlertWidget;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

$this->title = Html::encode('Восстановление пароля');
?>

<?= AlertWidget::widget(); ?>

<div class="reset-login">
    <h1><?= $this->title ?></h1>

    <p>Пожалуйста укажите Ваш E-mail. На него будет выслана ссылка для восстановления пароля</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'fieldConfig' => [
                    'template' => '{input}' . PHP_EOL . '{error}',
                ],
            ]); ?>

            <?= $form->field($model, 'email')->textInput([
                'autofocus' => true,
                'placeholder' => $model->getAttributeLabel('email'),
            ]) ?>

            <?= $form->field($model, 'verifyCode')->widget(
                Captcha::className(), [
                'captchaAction' => '/cabinet/login/captcha',
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => $model->getAttributeLabel('verifyCode'),
                ],
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('yii', 'Reset'), ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
