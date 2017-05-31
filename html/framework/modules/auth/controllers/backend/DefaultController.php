<?php

namespace app\modules\auth\controllers\backend;

use app\modules\auth\models\Login;
use app\modules\cp\components\backend\Controller;
use Yii;

/**
 * Default controller for the `auth` module
 */
class DefaultController extends Controller
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'cmf2' : null,
            ],
        ];
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->getUser()->getIsGuest()) {
            return $this->redirect(Yii::$app->getUser()->getReturnUrl());
        }

        $model = new Login();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->getUser()->getReturnUrl());
        }

        return $this->render(
            'login',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->getUser()->logout(false);

        return $this->goHome();
    }
}
