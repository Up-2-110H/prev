<?php

use app\assets\AppAsset;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin(
        [
            'brandLabel' => Yii::$app->name,
            'brandOptions' => ['target' => '_blank'],
            'options' => [
                'class' => 'navbar navbar-inverse navbar-fixed-top',
                'style' => 'z-index: 1031; border-color: transparent;',
            ],
        ]
    );
    NavBar::end();
    ?>
    <div class="container">
        <?=
        Breadcrumbs::widget(
            [
                'homeLink' => [
                    'label' => 'Администрирование',
                    'url' => ['/'],
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>

        <?= \app\widgets\alert\AlertWidget::widget(); ?>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= (new DateTime())->format('Y') ?></p>

        <p class="pull-right">
            <?=
            Yii::t(
                'yii',
                'Framework {version_core}',
                [
                    'version_core' => Yii::getVersion(),
                ]
            ) ?>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
