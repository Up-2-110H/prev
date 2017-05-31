<?php

namespace app\modules\cp;

use app\modules\cp\components\backend\AccessControl;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Application;

/**
 * cp module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @var array
     */
    public $except = [
        'auth/default/login',
        'auth/default/logout',
        'auth/default/captcha',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->registerErrorHandler();
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'except' => $this->except,
                ],
            ]
        );
    }

    public function registerErrorHandler()
    {
        if (Yii::$app instanceof Application) {
            Yii::$app->getErrorHandler()->errorAction = 'cp/default/error';
        }
    }
}
