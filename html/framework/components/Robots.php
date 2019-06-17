<?php


namespace app\components;


use app\interfaces\IRobots;
use app\models\ArrayData;
use yii\base\Component;

/**
 * Class Robots
 * @property ArrayData data
 * @property RobotsFile file
 * @property RobotsUserAgent userAgent
 * @property RobotsAllow allow
 * @property RobotsDisallow disallow
 * @property RobotsSitemap sitemap
 * @property RobotsCleanParam cleanParam
 * @property RobotsCrawlDelay crawlDelay
 * @package app\components
 */
class Robots extends Component implements IRobots
{
    /**
     * @var ArrayData
     */
    private $_data;
    /**
     * @var RobotsFile
     */
    private $_file;
    /**
     * @var RobotsUserAgent
     */
    private $_userAgent;
    /**
     * @var RobotsAllow
     */
    private $_allow;
    /**
     * @var RobotsDisallow
     */
    private $_disallow;
    /**
     * @var RobotsSitemap
     */
    private $_sitemap;
    /**
     * @var RobotsCleanParam
     */
    private $_cleanParam;
    /**
     * @var RobotsCrawlDelay
     */
    private $_crawlDelay;


    public function __construct(array $config = [])
    {
        $this->_data = new ArrayData();
        $this->_file = new RobotsFile();
        $this->_userAgent = new RobotsUserAgent($this->_data);
        $this->_allow = new RobotsAllow($this->_data);
        $this->_disallow = new RobotsDisallow($this->_data);
        $this->_sitemap = new RobotsSitemap($this->_data);
        $this->_cleanParam = new RobotsCleanParam($this->_data);
        $this->_crawlDelay = new RobotsCrawlDelay($this->_data);

        parent::__construct($config);
    }


    public function getFile(): RobotsFile
    {
        return $this->_file;
    }

    public function getData(): ArrayData
    {
        return $this->_data;
    }

    public function getUserAgent(): RobotsUserAgent
    {
        return $this->_userAgent;
    }


    public function getAllow(): RobotsAllow
    {
        return $this->_allow;
    }


    public function getDisallow(): RobotsDisallow
    {
        return $this->_disallow;
    }


    public function getSitemap(): RobotsSitemap
    {
        return $this->_sitemap;
    }


    public function getCleanParam(): RobotsCleanParam
    {
        return $this->_cleanParam;
    }


    public function getCrawlDelay(): RobotsCrawlDelay
    {
        return $this->_crawlDelay;
    }


    public function list(): array
    {
        return $this->_data->getData();
    }


    public function clear(): void
    {
        $this->_data->clear();
    }


    public function disableAll(): void
    {
        $this->clear();
        $this->_userAgent->addAll();
        $this->_disallow->all();
    }
}