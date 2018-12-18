<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 04.06.17
 * Time: 18:36
 */

use krok\clock\ClockWidget;
use krok\extend\widgets\alert\AlertWidget;
use krok\language\LanguageWidget;
use krok\paperdashboard\assets\PaperdashboardAsset;
use krok\paperdashboard\assets\ThemifyIconsAsset;
use krok\paperdashboard\widgets\menu\DropDownWidget;
use krok\paperdashboard\widgets\menu\MenuWidget;
use krok\paperdashboard\widgets\search\SearchWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $content string */

PaperdashboardAsset::register($this);
ThemifyIconsAsset::register($this);
YiiAsset::register($this);

/** @var \krok\configure\helpers\ConfigureHelperInterface $configure */
$configure = Yii::createObject(\krok\configure\helpers\ConfigureHelperInterface::class);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper">
    <div class="sidebar" data-background-color="blue" data-active-color="danger">
        <div class="logo">
            <a href="<?= Url::to(['/']) ?>" class="simple-text logo-mini">
                <?= Html::img($configure->get(\krok\system\Configure::class, 'logo'), ['alt' => 'Лого']) ?>
            </a>
            <a href="<?= Url::to(['/']) ?>" class="simple-text logo-normal">
                <?= $configure->get(\krok\system\Configure::class, 'title') ?>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <div class="user">
                    <div class="photo"></div>
                    <div class="info">
                        <li>
                            <a data-toggle="collapse" href="#profile" class="collapsed">
                                <p>
                                    <?= ArrayHelper::getValue(Yii::$app->getUser()->getIdentity(), 'login') ?>
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="clearfix"></div>
                            <div class="collapse" id="profile">
                                <ul class="nav">
                                    <li>
                                        <a href="<?= Url::to(['/auth/profile']) ?>">
                                            <p class="sidebar-normal">
                                                Мой профиль
                                            </p>
                                            <i class="ti-angle-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= Url::to(['/auth/social']) ?>">
                                            <p class="sidebar-normal">
                                                Социальные сети
                                            </p>
                                            <i class="ti-angle-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= Url::to(['/auth/default/logout']) ?>">
                                            <p class="sidebar-normal">
                                                Выход
                                            </p>
                                            <i class="ti-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </div>
                </div>
            </ul>
            <?= MenuWidget::widget([
                'items' => ArrayHelper::getValue(Yii::$app->params, ['menu']),
            ]) ?>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand btn-magnify" target="_blank" href="/">
                        <span class="full-name">Перейти на сайт</span>
                        <i class="ti-new-window"></i>
                    </a>
                    <?php if (Yii::$app->hasModule('search')) : echo SearchWidget::widget(); endif; ?>
                    <div class="navbar navbar-left navbar-text">
                        <?= ClockWidget::widget([
                            'options' => [
                                'class' => 'navbar-text',
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right header__navbar-right">
                        <li class="header-out">
                            <a class="btn-magnify" href="<?= Url::to(['/auth/default/logout']) ?>">
                                <i class="ti-shift-left"></i>
                                <p class="hidden-text-nav">Выход</p>
                            </a>
                        </li>
                    </ul>
                    <?= DropDownWidget::widget([
                        'items' => ArrayHelper::getValue(Yii::$app->params, 'dropdown', []),
                    ]) ?>
                    <?= LanguageWidget::widget([
                        'options' => [
                            'class' => 'nav navbar-nav navbar-right header__navbar-right',
                        ],
                    ]) ?>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?= AlertWidget::widget() ?>
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            © 2016–<?= (new DateTime())->format('Y') ?>
                            &nbsp;<?= $configure->get(\krok\system\Configure::class, 'copyright') ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </footer>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
