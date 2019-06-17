<?php


namespace app\components;

use app\interfaces\IArrayData;
use Yii;
use yii\base\BaseObject;

/**
 * Class RobotsFile
 * @package app\components
 */
class RobotsFile extends BaseObject
{
    /**
     * @var resource
     */
    private $_file;

    private const FILENAME = 'robots.txt';

    public function __construct($config = [])
    {
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

    /**
     * Записывает содержимое $data в файл robots.txt
     * @param IArrayData $data
     * @return bool
     */
    public function text(IArrayData $data): bool
    {
        if (!$this->open('w')) {
            return false;
        }

        foreach ($data->getData() as $param) {
            $fw = fwrite($this->_file, $param[0] . ': ' . $param[1] . PHP_EOL);

            if ($fw === false) {
                return false;
            }
        }

        if (!$this->close()) {
            return false;
        }

        return true;
    }

    /**
     * Записывает содержимое $data в конец файла robots.txt
     * @param IArrayData $data
     * @return bool
     */
    public function append(IArrayData $data): bool
    {
        if (!$this->open('a')) {
            return false;
        }

        foreach ($data as $param) {
            $fw = fwrite($this->_file, $param[0] . ': ' . $param[1] . '\n');

            if ($fw === false) {
                return false;
            }
        }

        if (!$this->close()) {
            return false;
        }

        return true;
    }

    /**
     * очищает содержимое файла robots.txt
     * @return bool
     */
    public function clear(): bool
    {
        if (!$this->open('w') || !$this->close()) {
            return false;
        }

        return true;
    }
}