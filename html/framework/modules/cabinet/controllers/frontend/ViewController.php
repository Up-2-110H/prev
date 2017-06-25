<?php

namespace app\modules\cabinet\controllers\frontend;

use app\modules\cabinet\components\UserFactory;
use app\modules\cabinet\models\Client;
use Yii;
use yii\base\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class ViewController
 *
 * @package app\modules\cabinet\controllers\frontend
 */
class ViewController extends Controller
{
    /**
     * @var string
     */
    public $layout = '//index';

    /**
     * @var UserFactory|null
     */
    protected $factory = null;

    /**
     * ViewController constructor.
     *
     * @param string $id
     * @param Module $module
     * @param UserFactory $factory
     * @param array $config
     */
    public function __construct($id, Module $module, UserFactory $factory, array $config = [])
    {
        $this->factory = $factory;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = $this->findModel(Yii::$app->getUser()->getIdentity()->getId());

        return $this->render('index', ['model' => $model]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->getUser()->logout(false);

        return $this->goHome();
    }

    /**
     * @param int $id
     *
     * @return Client|array|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $client = $this->factory->model('Client');
        if (($model = $client::find()->byIdNotBlocked($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
