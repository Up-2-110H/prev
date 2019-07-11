<?php


namespace app\components;

use app\interfaces\IArrayData;
use app\interfaces\IRobotsFile;
use Yii;
use yii\base\BaseObject;

/**
 * Class RobotsFile
 * @package app\components
 */
class RobotsFile extends BaseObject implements IRobotsFile
{
    /**
     * @var resource
     */
    private $_data;
    private $_file;

    private const FILENAME = 'robots.txt';

    public function __construct(?IArrayData $data = null, $config = [])
    {
        $this->_data = $data;
        parent::__construct($config);
    }

    /**
     * Открывает файл robots.txt в режиме $mode и
     * присваивает resource в $this->_file.
     * Возвращает
     * true - если успешно
     * false - если не успешно
     *
     * @param string $mode
     * @return bool
     */
    private function open(string $mode): bool
    {
        $fp = fopen(Yii::getAlias('@webroot') . '/' . self::FILENAME, $mode);

        if (!$fp) {
            return false;
        }

        $this->_file = $fp;
        return true;
    }

    /**
     * Закрывает файл robots.txt
     * Возвращает
     * true - если успешно
     * false - если не успешно
     *
     * @return bool
     */
    private function close(): bool
    {
        return fclose($this->_file);
    }

    private function write(): bool
    {
        foreach ($this->_data->getData() as $param) {
            $fw = fwrite($this->_file, $param[0] . ': ' . $param[1] . PHP_EOL);

            if ($fw === false) {
                return false;
            }
        }

        return true;
    }

    public function text(): bool
    {
        if ($this->_data == null || !$this->open('w') ||
            !$this->write() || $this->close()) {
            return false;
        }

        return true;
    }

    public function append(): bool
    {
        if ($this->_data == null || !$this->open('a') ||
            !$this->write() || $this->close()) {
            return false;
        }

        return true;
    }

    public function clear(): bool
    {
        if (!$this->open('w') || !$this->close()) {
            return false;
        }

        return true;
    }
}