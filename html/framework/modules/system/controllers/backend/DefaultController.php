<?php

namespace app\modules\system\controllers\backend;

use app\modules\system\components\backend\Controller;
use Yii;

/**
 * Default controller for the `system` module
 */
class DefaultController extends Controller
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return \yii\web\Response
     */
    public function actionFlushCache()
    {
        /* @var $authManager \yii\rbac\DbManager */
        $authManager = Yii::$app->getAuthManager();
        $authManager->invalidateCache();

        Yii::$app->getCache()->flush();

        Yii::$app->getSession()->addFlash('success', 'Кэш очищен');

        return $this->redirect(Yii::$app->getRequest()->getReferrer());
    }
}
