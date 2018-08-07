<?php

namespace krok\content;

use krok\system\components\backend\NameInterface;
use Yii;

/**
 * content module definition class
 */
class Module extends \yii\base\Module implements NameInterface
{
    /**
     * @var array
     */
    public $layouts = [];

    /**
     * @var array
     */
    public $views = [];

    /**
     * @inheritdoc
     */
    public $controllerNamespace = null;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    public static function getName()
    {
        return Yii::t('system', 'Content');
    }
}
