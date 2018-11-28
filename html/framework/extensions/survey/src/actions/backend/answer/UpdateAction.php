<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 12:58
 */

namespace krok\survey\actions\backend\answer;

use Yii;
use yii\web\Response;

/**
 * Class UpdateAction
 *
 * @package krok\survey\actions\backend\answer
 */
class UpdateAction extends FindAction
{
    /**
     * @var string
     */
    public $view = 'update';

    /**
     * @param $id
     *
     * @return string|Response
     */
    public function run($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            return $this->controller->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->controller->render($this->view, [
                'model' => $model,
            ]);
        }
    }
}
