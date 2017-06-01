<?php

namespace app\modules\auth;

use app\modules\cp\components\backend\NameInterface;

/**
 * auth module definition class
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
    }

    /**
     * @return string
     */
    public static function getName()
    {
        return 'Управление пользователями';
    }
}
