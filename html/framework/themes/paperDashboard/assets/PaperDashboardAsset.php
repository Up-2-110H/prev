<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 04.06.17
 * Time: 15:35
 */

namespace app\themes\paperDashboard\assets;

use yii\web\AssetBundle;

/**
 * Class PaperDashboardAsset
 *
 * @package app\themes\paperDashboard\assets
 */
class PaperDashboardAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@themes/paperDashboard/assets/dist';

    /**
     * @var array
     */
    public $css = [
        'css/paper-dashboard.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'js/paper-dashboard.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii\web\JqueryAsset',
        //'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'app\themes\paperDashboard\assets\BootstrapDateTimePickerAsset',
        //'app\themes\paperDashboard\assets\BootstrapNotifyAsset',
        //'app\themes\paperDashboard\assets\BootstrapSelectPickerAsset',
        'app\themes\paperDashboard\assets\BootstrapSwitchTagsAsset',
        //'app\themes\paperDashboard\assets\BootstrapTableAsset',
        //'app\themes\paperDashboard\assets\ChartIstAsset',
        'app\themes\paperDashboard\assets\Es6PromiseAutoAsset',
        //'app\themes\paperDashboard\assets\FullCalendarAsset',
        //'app\themes\paperDashboard\assets\JqueryBootstrapWizardAsset',
        //'app\themes\paperDashboard\assets\JqueryDataTablesAsset',
        //'app\themes\paperDashboard\assets\JqueryEasyPieChartAsset',
        //'app\themes\paperDashboard\assets\JqueryJVectorMapAsset',
        //'app\themes\paperDashboard\assets\JqueryValidateAsset',
        //'app\themes\paperDashboard\assets\NoUiSliderAsset',
        //'app\themes\paperDashboard\assets\PerfectScrollbarAsset',
        'app\themes\paperDashboard\assets\SweetAlert2Asset',
    ];
}
