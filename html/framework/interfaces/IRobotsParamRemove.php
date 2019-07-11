<?php


namespace app\interfaces;


/**
 * Interface IRobotsParamRemove
 * @package app\interfaces
 */
interface IRobotsParamRemove
{

    /**
     * Удаляет параметр соответствующего типа с индексом $index
     * @param int $index
     * @return bool
     */
    public function remove(int $index): bool;
}