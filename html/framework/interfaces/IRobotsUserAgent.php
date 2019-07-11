<?php


namespace app\interfaces;


/**
 * Interface IRobotsUserAgent
 * @package app\interfaces
 */
interface IRobotsUserAgent extends IRobotsParam, IRobotsParamRemove
{
    /**
     * Добавляет параметр типа User-agent со значением '*'
     * @return int
     */
    public function addAll(): int;

    /**
     * Добавляет параметр типа User-agent со значением 'Yandex'
     * @return int
     */
    public function addYandex(): int;

    /**
     * Добавляет параметр типа User-agent со значением 'YandexBot'
     * @return int
     */
    public function addYandexBot(): int;

    /**
     * Добавляет параметр типа User-agent со значением 'YandexCalendar'
     * @return int
     */
    public function addYandexCalendar(): int;

    /**
     * Добавляет параметр типа User-agent со значением 'YandexDirect'
     * @return int
     */
    public function addYandexDirect(): int;

    /**
     * Добавляет параметр типа User-agent со значением 'YandexDirectDyn'
     * @return int
     */
    public function addYandexDirectDyn(): int;

    /**
     * Добавляет параметр типа User-agent со значением 'YaDirectFetcher'
     * @return int
     */
    public function addYandexDirectFetcher(): int;

    /**
     * Добавляет параметр типа User-agent со значением 'YandexImages'
     * @return int
     */
    public function addYandexImages(): int;

    /**
     * Добавляет параметр типа User-agent со значением 'YandexMarket'
     * @return int
     */
    public function addYandexMarket(): int;

    /**
     * Добавляет параметр типа User-agent со значением 'YandexMedia'
     * @return int
     */
    public function addYandexMedia(): int;

    /**
     * Добавляет параметр типа User-agent со значением 'YandexMetrika'
     * @return int
     */
    public function addYandexMetrika(): int;

    /**
     * Добавляет параметр типа User-agent со значением 'YandexNews'
     * @return int
     */
    public function addYandexNews(): int;

    /**
     * Добавляет параметр типа User-agent со значением 'YandexPageChecker'
     * @return int
     */
    public function addYandexPageChecker(): int;
}