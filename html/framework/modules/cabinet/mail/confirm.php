<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 07.12.16
 * Time: 15:18
 */

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\models\Client */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<p>
    Для смены пароля перейдите по <?= Html::a('ссылке',
        Url::to(['reset', 'token' => $model->reset_token], true)) ?>
</p>
