<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 04.06.17
 * Time: 18:36
 */

/* @var $this yii\web\View */
/* @var $content string */

use app\assets\BootstrapSelectAsset;
use app\themes\paperDashboard\assets\PaperDashboardAsset;
use app\themes\paperDashboard\assets\ThemifyIconsAsset;
use app\themes\paperDashboard\widgets\menu\MenuWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;

BootstrapSelectAsset::register($this);
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
            <a href="http://nsign.ru" class="simple-text logo-mini">NS</a>
            <a href="http://nsign.ru" class="simple-text logo-mini logo-normal">NSign</a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo"></div>
                <div class="info">
                    <a data-toggle="collapse" href="#profile" class="collapsed">
                        <span>
                            <?= ArrayHelper::getValue(Yii::$app->getUser()->getIdentity(), 'login') ?><b
                                    class="caret"></b>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse" id="profile">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="sidebar-normal">Мой профиль</span>
                                </a>
                                <a href="<?= Url::to(['/auth/default/logout']) ?>">
                                    <span class="sidebar-normal">Выход</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

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
