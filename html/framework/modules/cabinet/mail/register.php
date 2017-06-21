<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.12.16
 * Time: 11:45
 */

/* @var $this yii\web\View */
/* @var $model app\modules\cabinet\models\Client */

use yii\helpers\Url;

?>
Добрый день!<br/>
Вы успешно зарегистрированы в Личном кабинете на сайте <?= Url::to('/', true) ?><br/>
Ваш логин для входа в Личный кабинет: <?= $model->login ?><br/>
Пароль для входа в Личный кабинет: <?= $model->pwd ?><br/>
