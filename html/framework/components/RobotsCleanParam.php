<?php


namespace app\components;


use app\interfaces\IArrayData;
use app\interfaces\IRobotsCleanParam;
use yii\base\BaseObject;

/**
 * Class RobotsCleanParam
 * @package app\components
 */
class RobotsCleanParam extends BaseObject implements IRobotsCleanParam
{
    private $_data;

    private const PARAM_NAME = 'Clean-param';

    public function __construct(IArrayData $data, $config = [])
    {
        $this->_data = $data;
        parent::__construct($config);
    }

    public function add(string $param, string $value): int
    {
        return $this->_data->add(self::PARAM_NAME, $param . ' ' . $value);
    }

    public function remove(int $index): bool
    {
        return $this->_data->remove($index, self::PARAM_NAME);
    }

    public function change(int $index, string $param, string $value): bool
    {
        return $this->_data->change($index, self::PARAM_NAME, $param . ' ' . $value);
    }
}