<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 04.06.17
 * Time: 18:36
 */

/* @var $this yii\web\View */
/* @var $content string */

use app\themes\paperDashboard\assets\PaperDashboardAsset;
use app\themes\paperDashboard\assets\ThemifyIconsAsset;
use app\themes\paperDashboard\widgets\menu\MenuWidget;
use yii\helpers\Html;
use yii\web\YiiAsset;

PaperDashboardAsset::register($this);
ThemifyIconsAsset::register($this);
YiiAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title><?= Html::encode($this->title) ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta name="viewport" content="width=device-width"/>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper">
    <div class="sidebar" data-background-color="brown" data-active-color="danger">
        <div class="logo">
            <a href="http://nsign.ru" class="simple-text logo-mini">NSign</a>
            <a href="http://nsign.ru" class="simple-text logo-mini logo-normal">NSign</a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo"></div>
                <div class="info">
                    <a data-toggle="collapse" href="#profile" class="collapsed">
                        <span>Chet Faker<b class="caret"></b></span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse" id="profile">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="sidebar-normal">My Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <?= MenuWidget::widget([
                'items' => [
                    [
                        'label' => '1212',
                        'url' => '/',
                        'icon' => 'ti-calendar',
                    ],
                    [
                        'label' => '1212',
                        'url' => '/',
                        'items' => [
                            [
                                'label' => '1212',
                                'url' => '/',
                            ],
                            [
                                'label' => '1212',
                                'url' => '/',
                                'items' => [
                                    [
                                        'label' => '1212',
                                        'url' => '/',
                                    ],
                                    [
                                        'label' => '1212',
                                        'url' => '/',

                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'label' => '1212',
                        'url' => '/',
                    ],
                ],
            ]) ?>

        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <?= \yii\widgets\Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => 'Администрирование',
                        'url' => ['/'],
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => [
                        'class' => 'breadcrumbs nav navbar-nav',
                    ],
                    'activeItemTemplate' => '<li><a>{link}</a></li>',
                ]) ?>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="btn-rotate">
                                <i class="ti-settings"></i>
                                <p class="hidden-md hidden-lg">
                                    Settings
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
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
                            <?= Yii::$app->name ?> <?= (new DateTime())->format('Y') ?>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy;
                    <?= Yii::t(
                        'yii',
                        'Framework {version_core}',
                        [
                            'version_core' => Yii::getVersion(),
                        ]
                    ) ?>
                </div>
            </div>
        </footer>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
