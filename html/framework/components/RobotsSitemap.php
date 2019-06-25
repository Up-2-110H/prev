<?php


namespace app\components;


use app\interfaces\IArrayData;
use app\interfaces\IRobotsSitemap;
use yii\base\BaseObject;

/**
 * Class RobotsSitemap
 * @package app\components
 */
class RobotsSitemap extends BaseObject implements IRobotsSitemap
{
    private $_data;

    private const PARAM_NAME = 'Sitemap';

    public function __construct(IArrayData $data, $config = [])
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
}