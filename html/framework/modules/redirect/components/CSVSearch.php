<?php

namespace app\modules\redirect\components;

use app\modules\redirect\interfaces\ICSVNextLine;
use app\modules\redirect\interfaces\ICSVSearch;
use yii\base\BaseObject;

/**
 * Class CSVSearch
 * @package app\modules\redirect\components
 */
class CSVSearch extends BaseObject implements ICSVSearch
{
    /**
     * @var ICSVNextLine
     */
    private $_csvHandler;

    /**
     * CSVSearch constructor.
     * @param ICSVNextLine $csvHandler
     * @param array $config
     */
    public function __construct(ICSVNextLine $csvHandler, $config = [])
    {
        $this->_csvHandler = $csvHandler;
        parent::__construct($config);
    }

    /**
     * Ищет в csv по номеру столбца $col совпадение с $str
     * если найдет, возвращает строку нахождения
     * иначе массив с элементом null
     *
     * @param string $str
     * @param int $col
     * @return array
     */
    public function search(string $str, int $col): array
    {

        while ($row = $this->_csvHandler->nextLine()) {
            if ($row === [false]) {
                return $row;
            }

            if (count($row) <= $col) {
                continue;
            }

            if ($str == trim($row[$col])) {
                return $row;
            }
        }

        return [false];
    }
}