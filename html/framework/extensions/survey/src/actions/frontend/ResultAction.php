<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.11.18
 * Time: 16:18
 */

namespace krok\survey\actions\frontend;

use yii\base\Action;

/**
 * Class ResultAction
 *
 * @package krok\survey\actions\frontend
 */
class ResultAction extends Action
{
    /**
     * @var string
     */
    public $view = 'result';

    /**
     * @return string
     */
    public function run()
    {
        return $this->controller->render($this->view);
    }
}
