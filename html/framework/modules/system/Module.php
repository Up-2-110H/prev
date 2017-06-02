<?php

namespace app\modules\system;

use app\modules\system\components\backend\NameInterface;

/**
 * system module definition class
 */
class Module extends \yii\base\Module implements NameInterface
{
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

        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public static function getName()
    {
        return 'Администрирование';
    }
}
