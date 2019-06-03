<?php

namespace app\modules\redirect;

use yii\base\Application;
use yii\base\BootstrapInterface;
use app\modules\redirect\components\CSVHandler;

/**
 * Class Module
 * @package app\modules\redirect
 */
class Module extends \yii\base\Module implements BootstrapInterface
{

    public function init()
    {
        parent::init();
    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     * @throws \yii\base\InvalidConfigException
     */
    public function bootstrap($app)
    {
        $url = $app->getRequest()->getUrl();
        $csvHandler = new CSVHandler('@app/modules/redirect/web/redirect.csv');
        $csvHandler->url = $url;

        if ($csvHandler->redirect()) {
            die();
        }
    }
}