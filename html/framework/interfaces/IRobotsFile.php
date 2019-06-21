<?php


namespace app\interfaces;


/**
 * Interface IRobotsFile
 * @package app\interfaces
 */
interface IRobotsFile
{
    /**
     * Записивает данные в файл robots.txt предварительно его очистив
     * @return bool
     */
    public function text(): bool;

    /**
     * Записивает данные в конец файла robots.txt
     * @return bool
     */
    public function append(): bool;

    /**
     * Очищает файл robots.txt
     * @return bool
     */
    public function clear(): bool;
}