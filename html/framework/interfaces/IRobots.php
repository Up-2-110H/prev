<?php


namespace app\interfaces;


use app\components\RobotsAllow;
use app\components\RobotsCleanParam;
use app\components\RobotsCrawlDelay;
use app\components\RobotsDisallow;
use app\components\RobotsFile;
use app\components\RobotsSitemap;
use app\components\RobotsUserAgent;

/**
 * Interface IRobots
 * @property RobotsFile file
 * @property RobotsUserAgent userAgent
 * @property RobotsAllow allow
 * @property RobotsDisallow disallow
 * @property RobotsSitemap sitemap
 * @property RobotsCleanParam cleanParam
 * @property RobotsCrawlDelay crawlDelay
 * @package app\interfaces
 */
interface IRobots
{
    /**
     * @return IRobotsFile
     */
    public function getFile(): IRobotsFile;

    /**
     * @return IRobotsUserAgent
     */
    public function getUserAgent(): IRobotsUserAgent;

    /**
     * @return IRobotsAllow
     */
    public function getAllow(): IRobotsAllow;

    /**
     * @return IRobotsDisallow
     */
    public function getDisallow(): IRobotsDisallow;

    /**
     * @return IRobotsSitemap
     */
    public function getSitemap(): IRobotsSitemap;

    /**
     * @return IRobotsCleanParam
     */
    public function getCleanParam(): IRobotsCleanParam;

    /**
     * @return IRobotsCrawlDelay
     */
    public function getCrawlDelay(): IRobotsCrawlDelay;

    /**
     * возвращает содержимое data
     * @return array
     */
    public function list(): array;

    /**
     * очищает содержимое data
     */
    public function clear(): void;

    /**
     * запрещает доступ к сайту для роботов
     */
    public function disableAll(): void;
}