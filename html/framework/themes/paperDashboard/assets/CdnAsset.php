<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 04.06.17
 * Time: 18:06
 */

namespace app\themes\paperDashboard\assets;

use yii\web\AssetBundle;

/**
 * Class CdnAsset
 *
 * @package app\themes\paperDashboard\assets
 */
class CdnAsset extends AssetBundle
{
    /**
     * @var array
     */
    public $css = [
        'http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
        'https://fonts.googleapis.com/css?family=Muli:400,300',
    ];
}
