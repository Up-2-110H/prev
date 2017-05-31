<?php

namespace app\modules\cp;

use Yii;
use yii\web\Application;

/**
 * cp module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->registerErrorHandler();
    }

    public function registerErrorHandler()
    {
        if (Yii::$app instanceof Application) {
            Yii::$app->getErrorHandler()->errorAction = 'cp/default/error';
        }
    }
}
