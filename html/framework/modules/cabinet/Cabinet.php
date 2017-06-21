<?php

namespace app\modules\cabinet;

use app\modules\system\components\backend\NameInterface;
use Yii;
use yii\filters\AccessControl;

/**
 * cabinet module definition class
 */
class Cabinet extends \yii\base\Module implements NameInterface
{
    /**
     * @var string
     */
    public $user = 'user';

    /**
     * @var array
     */
    public $rules = [];

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
     * @return array
     */
    public function behaviors()
    {
        return [
            'AccessControl' => [
                'class' => AccessControl::className(),
                'user' => $this->user,
                'rules' => $this->rules,
            ],
        ];
    }

    /**
     * @return string
     */
    public static function getName()
    {
        return Yii::t('system', 'Cabinet');
    }
}
