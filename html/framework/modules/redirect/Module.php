<?php

namespace app\modules\redirect;

use Yii;
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
        if (file_exists(Yii::getAlias('@app/modules/redirect/web/redirect.csv'))) {
            $csv = fopen(Yii::getAlias('@app/modules/redirect/web/redirect.csv'), 'r');
            $url = $app->getRequest()->getUrl();

            while ($row = fgetcsv($csv)) {
                if ($url == trim($row[0])) {
                    header('Location: ' . $row[1], true, $row[2]);
                    die();
                }
            }
        }
    }
}