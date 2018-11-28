<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 12:53
 */

namespace krok\survey\actions\backend\answer;

use krok\survey\models\Answer;
use Yii;
use yii\base\Action;

/**
 * Class CreateAction
 *
 * @package krok\survey\actions\backend\answer
 */
class CreateAction extends Action
{
    /**
     * @var string
     */
    public $view = 'create';

    /**
     * @param int $id
     *
     * @return string|\yii\web\Response
     */
    public function run(int $id)
    {
        $model = new Answer([
            'questionId' => $id,
        ]);

        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            return $this->controller->redirect(['index', 'id' => $id]);
        } else {
            return $this->controller->render($this->view, [
                'model' => $model,
            ]);
        }
    }
}
