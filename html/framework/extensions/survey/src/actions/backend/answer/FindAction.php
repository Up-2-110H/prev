<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 12:57
 */

namespace krok\survey\actions\backend\answer;

use krok\survey\models\Answer;
use yii\base\Action;
use yii\web\NotFoundHttpException;

/**
 * Class FindAction
 *
 * @package krok\survey\actions\backend\answer
 */
abstract class FindAction extends Action
{
    /**
     * @param int $id
     *
     * @return Answer
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id)
    {
        if (($model = Answer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
