<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 12:58
 */

namespace krok\survey\actions\backend\answer;

/**
 * Class ViewAction
 *
 * @package krok\survey\actions\backend\answer
 */
class ViewAction extends FindAction
{
    /**
     * @var string
     */
    public $view = 'view';

    /**
     * @param int $id
     *
     * @return string
     */
    public function run(int $id)
    {
        $model = $this->findModel($id);

        return $this->controller->render($this->view, [
            'model' => $model,
        ]);
    }
}
