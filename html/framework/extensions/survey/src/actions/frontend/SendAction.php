<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.11.18
 * Time: 16:01
 */

namespace krok\survey\actions\frontend;

use krok\survey\models\Survey;
use Yii;
use yii\base\Action;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class SendAction
 *
 * @package krok\survey\actions\frontend
 */
class SendAction extends Action
{
    /**
     * @var array
     */
    public $accessRedirect = ['result'];

    /**
     * @var array
     */
    public $errorRedirect = ['error'];

    /**
     * @param int $id
     *
     * @return Response
     */
    public function run(int $id)
    {
        $model = $this->findModel($id);
        $result = Yii::$app->getRequest()->post('answers', []);

        $transaction = Yii::$app->getDb()->beginTransaction();
        try {
            foreach ($model->questionsRelation as $question) {
                $answerIds = ArrayHelper::getValue($result, $question->id, []);
                $question->createType()->saveForm($answerIds);
            }
        } catch (Exception $e) {
            $transaction->rollBack();

            return $this->controller->redirect($this->errorRedirect);
        }
        $transaction->commit();

        return $this->controller->redirect($this->accessRedirect);
    }

    /**
     * @param int $id
     *
     * @return Survey
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id)
    {
        $model = Survey::find()->active()->byId($id)->one();

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            return $model;
        }
    }
}
