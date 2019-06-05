<?php

namespace app\modules\redirect\components;

use Yii;
use yii\base\BaseObject;

/**
 * Class FileHandler
 * @package app\modules\redirect\components
 */
class FileHandler extends BaseObject
{
    /**
     * @var resource $_file
     */
    private $_file;

    /**
     * FileHandler constructor.
     * @param string $filePath
     * @param array $config
     */
    public function __construct(string $filePath, $config = [])
    {
        $this->openFile($filePath);
        parent::__construct($config);
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->_file;
    }

    /**
     * @param string $filePath
     */
    private function openFile(string $filePath): void
    {

        if (!file_exists(Yii::getAlias($filePath))) {
            $this->_file = null;
            return;
        }

        $this->_file = fopen(Yii::getAlias($filePath), 'r');
    }
}