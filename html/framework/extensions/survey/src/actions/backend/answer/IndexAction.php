<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 12:43
 */

namespace krok\survey\actions\backend\answer;

use krok\survey\models\Answer;
use yii\base\Action;

/**
 * Class IndexAction
 *
 * @package krok\survey\actions\backend\answer
 */
class IndexAction extends Action
{
    /**
     * @var string
     */
    public $view = 'index';

    /**
     * @param int $id
     *
     * @return string
     */
    public function run(int $id)
    {
        $items = Answer::find()->byQuestionId($id)->orderByPosition()->all();

        return $this->controller->render($this->view, [
            'items' => $items,
        ]);
    }
}
