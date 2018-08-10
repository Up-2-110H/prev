<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 19.07.17
 * Time: 18:22
 */

namespace krok\auth\controllers\backend;

use krok\auth\models\Auth;
use krok\auth\models\Profile;
use krok\system\components\backend\Controller;
use Yii;

/**
 * Class ProfileController
 *
 * @package krok\auth\controllers\backend
 */
class ProfileController extends Controller
{
    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $profile = new Profile();

        if ($profile->load(Yii::$app->getRequest()->post()) && $profile->validate()) {

            $model = $this->findModel();
            $model->password = $profile->passwordNew;

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Пароль успешно изменен');
            } else {
                Yii::$app->getSession()->setFlash('danger', 'Ошибка изменения пароля');
            }
        }

        return $this->render('index', ['profile' => $profile]);
    }

    /**
     * @return null|\yii\web\IdentityInterface|Auth
     */
    protected function findModel()
    {
        return Yii::$app->getUser()->getIdentity();
    }
}
