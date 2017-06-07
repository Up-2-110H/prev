<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 06.06.17
 * Time: 17:36
 */

namespace app\themes\paperDashboard\widgets\grid;

use yii\grid\GridView;

/**
 * Class GridViewWidget
 *
 * @package app\themes\paperDashboard\widgets\grid
 */
class GridViewWidget extends GridView
{
    /**
     * @var array
     */
    public $tableOptions = ['class' => 'table table-striped'];

    /**
     * @var string
     */
    public $layout = '<div class="col-sm-5">{summary}</div>' . PHP_EOL . '{items}' . PHP_EOL . '<div class="pull-right pagination">{pager}</div>';
}
