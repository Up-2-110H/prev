<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.06.17
 * Time: 10:09
 */

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\form\ConfirmWithEmailForm */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>
Добрый день!<br/>
<?= Html::a('Ссылка для подтверждения Email',
    Url::to(ArrayHelper::merge(['confirm-with-email'], [$model->formName() => $model->toArray()]), true)) ?>
