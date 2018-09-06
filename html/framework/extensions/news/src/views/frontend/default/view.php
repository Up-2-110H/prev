<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 06.09.18
 * Time: 15:34
 */

/* @var $this yii\web\View */
/* @var $model \krok\news\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['url' => ['/news'], 'label' => 'Новости'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media">

    <div class="media-left media-middle">

        <?php if ($model->getSrc()) : ?>
            <img class="media-object" src="<?= $model->getPreview() ?>" alt="<?= $this->title ?>">
        <?php endif; ?>

    </div>

    <div class="media-body">
        <h4 class="media-heading">
            <?= $model->title ?>
        </h4>
        <?= $model->text ?>
    </div>

</div>
