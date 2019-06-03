<?php

namespace app\modules\redirect\components;

use app\modules\redirect\interfaces\ICheckCSV;
use app\modules\redirect\interfaces\IRedirect;
use Yii;
use yii\base\BaseObject;


/**
 * Class CSVHandler
 * @package app\modules\redirect\components
 */
class CSVHandler extends BaseObject implements ICheckCSV, IRedirect
{
    private $_csv;
    private $_url;

    /**
     * CSVHandler constructor.
     * @param string $csvPath путь к файлу csv
     * @param string $url текущий URL
     * @param array $config
     */
    public function __construct(?string $csvPath = null, ?string $url = null, $config = [])
    {
        $this->setUrl($url);
        $this->checkCSV($csvPath);

        parent::__construct($config);
    }

    public function setCsv(?string $value)
    {
        $this->checkCSV($value);
    }

    public function setUrl(?string $value)
    {
        $this->_url = $value;
    }

    /**
     * Проверяет существует ли файл,
     * если существует, файл открывается и свойству csv присваивается
     * если не существует, свойства csv принимает значение null
     *
     * @param string $csvPath
     */
    public function checkCSV(?string $csvPath): void
    {
        if ($csvPath == null || !file_exists(Yii::getAlias($csvPath))) {
            $this->_csv = null;
            return;
        }

        $this->_csv = fopen(Yii::getAlias($csvPath), 'r');
    }

    /**
     * Проверяет совпадает ли url хотя бы одним из адресов из csv
     * если совпадает, произойдет переадресация и возвращает true
     * иначе false
     *
     * @return bool
     */
    public function redirect(): bool
    {
        if ($this->_csv == null || $this->_url == null) {
            return false;
        }

        while ($row = fgetcsv($this->_csv)) {
            if ($this->_url == trim($row[0])) {
                header('Location: ' . $row[1], true, $row[2]);
                return true;
            }
        }

        return false;
    }
}
