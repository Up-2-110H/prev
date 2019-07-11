<?php


namespace app\models;


use app\interfaces\IArrayData;
use yii\base\Model;

/**
 * Class ArrayData
 * @package app\models
 */
class ArrayData extends Model implements IArrayData
{
    /**
     * @var array
     */
    private $_data;

    public function __construct($config = [])
    {
        $this->_data = [];

        parent::__construct($config);
    }

    public function getData(): array
    {
        return $this->_data;
    }

    public function add(string $type, string $value): int
    {
        return array_push($this->_data, [$type, $value]);
    }

    public function remove(int $index, string $type): bool
    {
        if (count($this->_data) > $index && $index >= 0 &&
            $this->_data[$index][0] == $type) {
            array_splice($this->_data, $index, 1);
            return true;
        }

        return false;
    }

    public function replace(int $index, string $type, string $value): bool
    {
        if (count($this->_data) > $index && $index >= 0) {
            $this->_data[$index][0] = $type;
            $this->_data[$index][1] = $value;
            return true;
        }

        return false;
    }

    public function change(int $index, string $type, string $value): bool
    {
        if (count($this->_data) > $index && $index >= 0 &&
            $this->_data[$index][0] == $type) {
            $this->_data[$index][1] = $value;
            return true;
        }

        return false;
    }

    public function clear(): void
    {
        $this->_data = [];
    }
}