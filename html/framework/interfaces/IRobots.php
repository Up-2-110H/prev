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
     * @return RobotsFile
     */
    public function getFile(): RobotsFile;

    /**
     * @return RobotsUserAgent
     */
    public function getUserAgent(): RobotsUserAgent;

    /**
     * @return RobotsAllow
     */
    public function getAllow(): RobotsAllow;

    /**
     * @return RobotsDisallow
     */
    public function getDisallow(): RobotsDisallow;

    /**
     * @return RobotsSitemap
     */
    public function getSitemap(): RobotsSitemap;

    /**
     * @return RobotsCleanParam
     */
    public function getCleanParam(): RobotsCleanParam;

    /**
     * @return RobotsCrawlDelay
     */
    public function getCrawlDelay(): RobotsCrawlDelay;

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