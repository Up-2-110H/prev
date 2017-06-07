<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 09.09.15
 * Time: 13:05
 */

namespace app\assets;

use Yii;
use yii\web\AssetBundle;
use yii\web\JsExpression;

/**
 * Class BootstrapSelectAsset
 *
 * @package app\assets
 */
class BootstrapSelectAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/bootstrap-select/bootstrap-select/dist';

    /**
     * @var array
     */
    public $js = [
        'js/bootstrap-select.min.js',
    ];

    /**
     * @var array
     */
    public $css = [
        'css/bootstrap-select.min.css',
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**
     * @param \yii\web\View $view
     */
    public function registerAssetFiles($view)
    {
        $this->registerLanguage();
        $this->registerClientScript($view);
        parent::registerAssetFiles($view);
    }

    public function registerLanguage()
    {
        $language = str_replace('-', '_', Yii::$app->language);

        $js = 'js/i18n/defaults-' . $language . '.js';

        if (file_exists($this->basePath . '/' . $js)) {
            $this->js[] = $js;
        }
    }

    /**
     * @param \yii\web\View $view
     */
    public function registerClientScript($view)
    {
        $view->registerJs(new JsExpression('jQuery(\'select\').selectpicker({\'size\': 10});'));
    }
}
