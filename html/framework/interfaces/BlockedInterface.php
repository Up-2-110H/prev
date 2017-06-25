<?php

/**
 * Created by PhpStorm.
 * User: krok
 * Date: 25.06.17
 * Time: 23:33
 */

namespace app\interfaces;

/**
 * Interface BlockedInterface
 *
 * @package app\interfaces
 */
interface BlockedInterface
{
    const BLOCKED_NO = 0;
    const BLOCKED_YES = 1;

    /**
     * @return array
     */
    public static function getBlockedList();

    /**
     * @return string
     */
    public function getBlocked();
}
