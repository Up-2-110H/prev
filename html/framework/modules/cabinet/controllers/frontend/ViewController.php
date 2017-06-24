<?php

namespace app\modules\cabinet\controllers\frontend;

use app\modules\cabinet\models\Client;
use Yii;
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
        if (($model = Client::find()->where(['id' => $id, 'blocked' => Client::BLOCKED_NO])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
