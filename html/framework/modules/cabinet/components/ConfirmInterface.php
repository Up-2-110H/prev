<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 22.06.17
 * Time: 11:44
 */

namespace app\modules\cabinet\components;

use yii\db\ActiveRecordInterface;

/**
 * Interface ConfirmInterface
 *
 * @package app\modules\cabinet\components
 */
interface ConfirmInterface
{
    /**
     * @return ActiveRecordInterface|null
     */
    public function findByConfirm();
}
