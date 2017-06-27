<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.06.17
 * Time: 9:36
 */

/* @var $this yii\web\View */
/* @var $accept bool */

use app\widgets\alert\AlertWidget;
use yii\helpers\Html;

$this->title = Html::encode('Подтверждение Email');
?>

<?= AlertWidget::widget(); ?>

<div class="default-confirm-with-email">
    <h1><?= $this->title ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php if ($accept) : ?>
                <p>Спасибо! Вы успешно подтвердили Email</p>
                <?= Html::a('Перейти в личный кабинет', ['view/index'], ['class' => 'btn btn-success']) ?>
            <?php else : ?>
                <p>Вам на указанный Email была отправленна ссылка для подтверждения</p>
                <?= Html::a('Отправить повторно', ['retry-with-email'], ['class' => 'btn btn-success']) ?>
            <?php endif; ?>
        </div>
    </div>
</div>
