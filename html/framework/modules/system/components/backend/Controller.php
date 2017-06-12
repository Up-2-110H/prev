<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 10.02.17
 * Time: 11:31
 */

namespace app\modules\system\components\backend;

use Yii;
use yii\web\ForbiddenHttpException;

/**
 * Class Controller
 *
 * @package app\modules\system\components\backend
 */
class Controller extends \yii\web\Controller
{
    /**
     * @var string
     */
    public $layout = '@app/modules/system/views/backend/layouts/index.php';

    /**
     * @param array $params
     *
     * @throws \yii\web\ForbiddenHttpException
     */
    protected function can(array $params)
    {
        if (!Yii::$app->getUser()->can($this->action->getUniqueId(), $params)) {
            throw new ForbiddenHttpException(Yii::t('app', 'You are not allowed to perform this action.'));
        }
    }
}
