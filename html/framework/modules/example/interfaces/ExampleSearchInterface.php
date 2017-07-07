<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 05.07.17
 * Time: 0:12
 */

namespace app\modules\example\interfaces;

use yii\data\ActiveDataProvider;

/**
 * Interface ExampleSearchInterface
 *
 * @package app\modules\example\interfaces
 */
interface ExampleSearchInterface
{
    /**
     * @return ActiveDataProvider
     */
    public function search();
}
