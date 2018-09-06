<?php

namespace krok\news\controllers\frontend;

use krok\news\models\News;
use krok\system\components\frontend\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Class DefaultController
 *
 * @package krok\news\controllers\frontend
 */
class DefaultController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->list()->hidden()->order(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param int $id
     *
     * @return string
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     *
     * @return News|null
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id)
    {
        $model = News::find()->byId($id);

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            return $model;
        }
    }
}
