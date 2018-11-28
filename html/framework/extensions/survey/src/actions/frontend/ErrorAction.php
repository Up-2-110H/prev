<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.11.18
 * Time: 16:42
 */

namespace krok\survey\actions\frontend;

use yii\base\Action;

/**
 * Class ErrorAction
 *
 * @package krok\survey\actions\frontend
 */
class ErrorAction extends Action
{
    /**
     * @var string
     */
    public $view = 'error';

    /**
     * @return string
     */
    public function run()
    {
        return $this->controller->render($this->view);
    }
}
