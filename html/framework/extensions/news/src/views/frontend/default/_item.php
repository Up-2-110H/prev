<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 06.09.18
 * Time: 15:46
 */

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $model \krok\news\models\News */
/* @var $key mixed */
/* @var $index integer */
/* @var $widget \yii\widgets\ListView */
?>
<div class="media">

    <div class="media-left media-middle">

        <?php if ($model->getSrc()) : ?>
            <a href="<?= Url::to(['view', 'id' => $model->id]) ?>">
                <img class="media-object" src="<?= $model->getPreview() ?>" alt="<?= $this->title ?>">
            </a>
        <?php endif; ?>

    </div>

    <div class="media-body">
        <h4 class="media-heading">
            <?= $model->title ?>
        </h4>
        <?= $model->announce ?>
    </div>

</div>
