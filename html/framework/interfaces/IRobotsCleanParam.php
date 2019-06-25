<?php


namespace app\interfaces;


/**
 * Interface IRobotsParam
 * @package app\interfaces
 */
interface IRobotsCleanParam extends IRobotsParamRemove
{
    /**
     * Добавляет новый параметр соответствующего типа со значением $value
     * Возвращает количество элементов
     * @param string $param
     * @param string $value
     * @return int
     */
    public function add(string $param, string $value): int;

    /**
     * Изменяет значение параметра соответствующего типа на значение $value
     * @param int $index
     * @param string $param
     * @param string $value
     * @return bool
     */
    public function change(int $index, string $param, string $value): bool;
}