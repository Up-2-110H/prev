<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 12:59
 */

namespace krok\survey\actions\backend\answer;

use yii\web\Response;

/**
 * Class DeleteAction
 *
 * @package krok\survey\actions\backend\answer
 */
class DeleteAction extends FindAction
{
    /**
     * @param int $id
     *
     * @return Response
     */
    public function run(int $id)
    {
        $this->findModel($id)->delete();

        return $this->controller->redirect(['index']);
    }
}
