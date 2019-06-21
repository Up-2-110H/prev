<?php


namespace app\components;


use app\interfaces\IArrayData;
use app\interfaces\IRobotsParam;
use app\interfaces\IRobotsParamRemove;
use app\interfaces\IRobotsUserAgent;
use yii\base\BaseObject;

/**
 * Class RobotsUserAgent
 * @package app\components
 */
class RobotsUserAgent extends BaseObject implements IRobotsParam, IRobotsUserAgent, IRobotsParamRemove
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

    public function addAll(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::ALL);
    }

    public function addYandex(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX);
    }

    public function addYandexBot(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_BOT);
    }

    public function addYandexCalendar(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_CALENDAR);
    }

    public function addYandexDirect(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_DIRECT);
    }

    public function addYandexDirectDyn(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_DIRECT_DYN);
    }

    public function addYandexDirectFetcher(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_DIRECT_FETCHER);
    }

    public function addYandexImages(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_IMAGES);
    }

    public function addYandexMarket(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_MARKET);
    }

    public function addYandexMedia(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_MEDIA);
    }

    public function addYandexMetrika(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_METRIKA);
    }

    public function addYandexNews(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_NEWS);
    }

    public function addYandexPageChecker(): int
    {
        return $this->_data->add(self::PARAM_NAME, self::YANDEX_PAGE_CHECKER);
    }
}