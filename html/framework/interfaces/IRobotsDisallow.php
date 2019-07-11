<?php


namespace app\interfaces;


/**
 * Interface IRobotsDisallow
 * @package app\interfaces
 */
interface IRobotsDisallow extends IRobotsParam, IRobotsParamRemove
{
    /**
     * Добавляет параметр типа Disallow со значением '/'
     */
    public function all(): void;
}