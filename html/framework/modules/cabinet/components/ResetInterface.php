<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 22.06.17
 * Time: 11:45
 */

namespace app\modules\cabinet\components;

use yii\db\ActiveRecordInterface;

/**
 * Interface ResetInterface
 *
 * @package app\modules\cabinet\components
 */
interface ResetInterface
{
    /**
     * @return ActiveRecordInterface|null
     */
    public function findByReset();
}
