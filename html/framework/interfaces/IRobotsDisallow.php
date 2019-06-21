<?php


namespace app\interfaces;


/**
 * Interface IRobotsDisallow
 * @package app\interfaces
 */
interface IRobotsDisallow
{
    /**
     * Добавляет параметр типа Disallow со значением '/'
     */
    public function all(): void;
}