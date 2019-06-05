<?php

namespace app\modules\redirect\components;

use app\modules\redirect\interfaces\ICSVNextLine;

/**
 * Class CSVHandler
 * @package app\modules\redirect\components
 */
class CSVHandler extends FileHandler implements ICSVNextLine
{
    /**
     * @return array
     */
    public function nextLine(): array
    {
        $csv = $this->getFile();

        if ($csv != null) {
            $row = fgetcsv($csv);
            return $row ? $row : [false];
        }

        return [false];
    }
}