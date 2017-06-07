<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 06.06.17
 * Time: 17:42
 */

namespace app\themes\paperDashboard\widgets\grid;

use yii\widgets\DetailView;

/**
 * Class DetailViewWidget
 *
 * @package app\themes\paperDashboard\widgets\grid
 */
class DetailViewWidget extends DetailView
{
    /**
     * @var array
     */
    public $options = ['class' => 'table table-striped detail-view'];
}
