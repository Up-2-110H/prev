<?php


namespace app\interfaces;


/**
 * Interface IArrayData
 * @package app\interfaces
 */
interface IArrayData
{
    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @param string $type
     * @param string $value
     * @return int количество элементов в массиве после добавления
     */
    public function add(string $type, string $value): int;

    /**
     * @param int $index
     * @param string $type
     * @return bool
     */
    public function remove(int $index, string $type): bool;

    /**
     * @param int $index
     * @param string $type
     * @param string $value
     * @return bool
     */
    public function replace(int $index, string $type, string $value): bool;

    /**
     * @param int $index
     * @param string $type
     * @param string $value
     * @return bool
     */
    public function change(int $index, string $type, string $value): bool;

    /**
     * очищает массив
     */
    public function clear(): void;
}