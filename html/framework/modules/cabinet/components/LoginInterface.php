<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 22.06.17
 * Time: 12:09
 */

namespace app\modules\cabinet\components;

use yii\db\ActiveRecordInterface;

/**
 * Interface LoginInterface
 *
 * @package app\modules\cabinet\components
 */
interface LoginInterface
{
    /**
     * @return ActiveRecordInterface|null
     */
    public function findByLogin();
}
