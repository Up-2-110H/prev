<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 25.06.17
 * Time: 23:35
 */

namespace app\traits;

use app\interfaces\BlockedInterface;
use yii\helpers\ArrayHelper;

/**
 * Trait BlockedTrait
 *
 * @package app\traits
 */
trait BlockedTrait
{
    /**
     * @return array
     */
    public static function getBlockedList()
    {
        return [
            BlockedInterface::BLOCKED_NO => 'Нет',
            BlockedInterface::BLOCKED_YES => 'Да',
        ];
    }

    /**
     * @return string
     */
    public function getBlocked()
    {
        return ArrayHelper::getValue(self::getBlockedList(), $this->blocked);
    }
}
