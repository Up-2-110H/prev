<?php

namespace app\modules\auth;

use app\modules\system\components\backend\NameInterface;

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
     * @var string
     */
    public $defaultRoute = 'auth';

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
