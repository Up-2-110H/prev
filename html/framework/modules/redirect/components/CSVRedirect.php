<?php

namespace app\modules\redirect\components;

use app\modules\redirect\interfaces\ICSVSearch;
use Yii;
use yii\base\BaseObject;


/**
 * Class CSVRedirect
 * @package app\modules\redirect\components
 */
class CSVRedirect extends BaseObject
{
    /**
     * @var ICSVSearch
     */
    private $_csvSearch;

    /**
     * CSVRedirect constructor.
     * @param ICSVSearch $csvSearch
     * @param array $config
     */
    public function __construct(ICSVSearch $csvSearch, $config = [])
    {
        $this->_csvSearch = $csvSearch;

        parent::__construct($config);
    }

    /**
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function redirect(): bool
    {
        $url = Yii::$app->getRequest()->getUrl();
        $row = $this->_csvSearch->search($url, 0);

        if (!$row[0]) {
            return false;
        }

        header('Location: ' . $row[1], true, $row[2]);
        return true;
    }
}
