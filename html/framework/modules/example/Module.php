<?php

namespace app\modules\example;

use app\modules\example\interfaces\ExampleInterface;
use app\modules\example\interfaces\ExampleSearchInterface;
use app\modules\example\models\Example;
use app\modules\example\models\ExampleSearch;
use krok\system\components\backend\NameInterface;
use Yii;

/**
 * example module definition class
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

        $this->registerContainer();
    }

    /**
     * @return string
     */
    public static function getName()
    {
        return Yii::t('system', 'Example');
    }

    public function registerContainer()
    {
        Yii::$container->set(ExampleInterface::class, Example::class);
        Yii::$container->set(ExampleSearchInterface::class, ExampleSearch::class);
    }
}
