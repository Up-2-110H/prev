<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 12:12
 */

namespace krok\survey\actions\backend\question;

use krok\survey\models\Question;
use yii\base\Action;
use yii\web\NotFoundHttpException;

/**
 * Class FindAction
 *
 * @package krok\survey\actions\backend\question
 */
abstract class FindAction extends Action
{
    /**
     * @param int $id
     *
     * @return Question
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
