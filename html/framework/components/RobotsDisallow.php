<?php


namespace app\components;


use app\interfaces\IArrayData;
use app\interfaces\IRobotsDisallow;
use app\interfaces\IRobotsParam;
use app\interfaces\IRobotsParamRemove;
use yii\base\BaseObject;

/**
 * Class RobotsDisallow
 * @package app\components
 */
class RobotsDisallow extends BaseObject implements IRobotsParam, IRobotsDisallow, IRobotsParamRemove
{
    private $_data;

    private const PARAM_NAME = 'Disallow';

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

    public function all(): void
    {
        $this->_data->add(self::PARAM_NAME, '/');
    }
}