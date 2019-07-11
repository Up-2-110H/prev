<?php


namespace app\components;


use app\interfaces\IRobots;
use app\interfaces\IRobotsAllow;
use app\interfaces\IRobotsCleanParam;
use app\interfaces\IRobotsCrawlDelay;
use app\interfaces\IRobotsDisallow;
use app\interfaces\IRobotsFile;
use app\interfaces\IRobotsSitemap;
use app\interfaces\IRobotsUserAgent;
use app\models\ArrayData;
use yii\base\Component;

/**
 * Class Robots
 * @package app\components
 */
class Robots extends Component implements IRobots
{
    /**
     * @var ArrayData
     */
    private $_data;
    /**
     * @var IRobotsFile
     */
    private $_file;
    /**
     * @var IRobotsUserAgent
     */
    private $_userAgent;
    /**
     * @var IRobotsAllow
     */
    private $_allow;
    /**
     * @var IRobotsDisallow
     */
    private $_disallow;
    /**
     * @var IRobotsSitemap
     */
    private $_sitemap;
    /**
     * @var IRobotsCleanParam
     */
    private $_cleanParam;
    /**
     * @var IRobotsCrawlDelay
     */
    private $_crawlDelay;


    public function __construct(array $config = [])
    {
        $this->_data = new ArrayData();
        $this->_file = new RobotsFile($this->_data);
        $this->_userAgent = new RobotsUserAgent($this->_data);
        $this->_allow = new RobotsAllow($this->_data);
        $this->_disallow = new RobotsDisallow($this->_data);
        $this->_sitemap = new RobotsSitemap($this->_data);
        $this->_cleanParam = new RobotsCleanParam($this->_data);
        $this->_crawlDelay = new RobotsCrawlDelay($this->_data);

        parent::__construct($config);
    }


    public function getFile(): IRobotsFile
    {
        return $this->_file;
    }

    public function getUserAgent(): IRobotsUserAgent
    {
        return $this->_userAgent;
    }


    public function getAllow(): IRobotsAllow
    {
        return $this->_allow;
    }


    public function getDisallow(): IRobotsDisallow
    {
        return $this->_disallow;
    }


    public function getSitemap(): IRobotsSitemap
    {
        return $this->_sitemap;
    }


    public function getCleanParam(): IRobotsCleanParam
    {
        return $this->_cleanParam;
    }


    public function getCrawlDelay(): IRobotsCrawlDelay
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