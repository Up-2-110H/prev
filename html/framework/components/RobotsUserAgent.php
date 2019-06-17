<?php


namespace app\components;


use app\interfaces\IArrayData;
use app\interfaces\IRobotsParam;
use app\interfaces\IRobotsParamRemove;
use yii\base\BaseObject;

/**
 * Class RobotsUserAgent
 * @package app\components
 */
class RobotsUserAgent extends BaseObject implements IRobotsParam, IRobotsParamRemove
{
    private $_data;

    private const PARAM_NAME = 'User-agent';
    private const ALL = '*';
    private const YANDEX = 'Yandex';
    private const YANDEX_BOT = 'YandexBot';
    private const YANDEX_CALENDAR = 'YandexCalendar';
    private const YANDEX_DIRECT = 'YandexDirect';
    private const YANDEX_DIRECT_DYN = 'YandexDirectDyn';
    private const YANDEX_DIRECT_FETCHER = 'YaDirectFetcher';
    private const YANDEX_IMAGES = 'YandexImages';
    private const YANDEX_MARKET = 'YandexMarket';
    private const YANDEX_MEDIA = 'YandexMedia';
    private const YANDEX_METRIKA = 'YandexMetrika';
    private const YANDEX_NEWS = 'YandexNews';
    private const YANDEX_PAGE_CHECKER = 'YandexPagechecker';

    public function __construct(IArrayData $data, array $config = [])
    {
        $this->_data = $data;
        parent::__construct($config);
    }

    public function add(string $value): int
    {
        return $this->_data->add(self::PARAM_NAME, $value);
    }

    public function remove(int $index): bool
    {
        return $this->_data->remove($index, self::PARAM_NAME);
    }

    public function change(int $index, string $value): bool
    {
        return $this->_data->change($index, self::PARAM_NAME, $value);
    }

    /**
     * Добавляет параметр типа User-agent со значением '*'
     * @return int
     */
    public function addAll(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::ALL);
    }

    /**
     * Добавляет параметр типа User-agent со значением 'Yandex'
     * @return int
     */
    public function addYandex(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX);
    }

    /**
     * Добавляет параметр типа User-agent со значением 'YandexBot'
     * @return int
     */
    public function addYandexBot(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_BOT);
    }

    /**
     * Добавляет параметр типа User-agent со значением 'YandexCalendar'
     * @return int
     */
    public function addYandexCalendar(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_CALENDAR);
    }

    /**
     * Добавляет параметр типа User-agent со значением 'YandexDirect'
     * @return int
     */
    public function addYandexDirect(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_DIRECT);
    }

    /**
     * Добавляет параметр типа User-agent со значением 'YandexDirectDyn'
     * @return int
     */
    public function addYandexDirectDyn(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_DIRECT_DYN);
    }

    /**
     * Добавляет параметр типа User-agent со значением 'YaDirectFetcher'
     * @return int
     */
    public function addYandexDirectFetcher(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_DIRECT_FETCHER);
    }

    /**
     * Добавляет параметр типа User-agent со значением 'YandexImages'
     * @return int
     */
    public function addYandexImages(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_IMAGES);
    }

    /**
     * Добавляет параметр типа User-agent со значением 'YandexMarket'
     * @return int
     */
    public function addYandexMarket(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_MARKET);
    }

    /**
     * Добавляет параметр типа User-agent со значением 'YandexMedia'
     * @return int
     */
    public function addYandexMedia(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_MEDIA);
    }

    /**
     * Добавляет параметр типа User-agent со значением 'YandexMetrika'
     * @return int
     */
    public function addYandexMetrika(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_METRIKA);
    }

    /**
     * Добавляет параметр типа User-agent со значением 'YandexNews'
     * @return int
     */
    public function addYandexNews(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_NEWS);
    }

    /**
     * Добавляет параметр типа User-agent со значением 'YandexPageChecker'
     * @return int
     */
    public function addYandexPageChecker(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_PAGE_CHECKER);
    }
}