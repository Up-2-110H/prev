<?php

namespace app\modules\redirect;

use app\modules\redirect\components\CSVHandler;
use app\modules\redirect\components\CSVRedirect;
use app\modules\redirect\components\CSVSearch;
use yii\base\Application;
use yii\base\BootstrapInterface;

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
        $csvHandler = new CSVHandler('@app/modules/redirect/web/redirect.csv');
        $csvSearch = new CSVSearch($csvHandler);
        $csvRedirect = new CSVRedirect($csvSearch);

        if ($csvRedirect->redirect()) {
            die();
        }
    }
}