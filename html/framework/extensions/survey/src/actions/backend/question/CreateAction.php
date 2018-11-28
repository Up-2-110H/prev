<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 11:20
 */

namespace krok\survey\actions\backend\question;

use krok\survey\models\Question;
use Yii;
use yii\base\Action;

/**
 * Class CreateAction
 *
 * @package krok\survey\actions\backend\question
 */
class CreateAction extends Action
{
    /**
     * @var string
     */
    public $view = 'create';

    /**
     * @var null|Question
     */
    public $model = null;

    /**
     * @param int $id
     *
     * @return string|\yii\web\Response
     */
    public function run(int $id)
    {
        $this->model->surveyId = $id;

        if ($this->model->load(Yii::$app->getRequest()->post()) && $this->model->save()) {
            return $this->controller->redirect(['index', 'id' => $id]);
        } else {
            return $this->controller->render($this->view, [
                'model' => $this->model,
            ]);
        }
    }
}
