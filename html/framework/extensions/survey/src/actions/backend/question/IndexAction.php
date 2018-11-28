<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 10:01
 */

namespace krok\survey\actions\backend\question;

use krok\survey\models\Question;
use yii\base\Action;

/**
 * Class IndexAction
 *
 * @package krok\survey\actions\backend\question
 */
class IndexAction extends Action
{
    /**
     * @var string
     */
    public $view = 'index';

    /**
     * @var array
     */
    public $types = [];

    /**
     * @param int $id
     *
     * @return string
     */
    public function run(int $id)
    {
        $items = Question::find()->bySurveyId($id)->orderByPosition()->all();

        return $this->controller->render($this->view, [
            'items' => $items,
            'types' => $this->types,
        ]);
    }
}
