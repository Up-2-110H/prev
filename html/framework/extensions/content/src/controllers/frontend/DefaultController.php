<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 07.08.18
 * Time: 12:25
 */

namespace krok\content\controllers\frontend;

use krok\content\actions\frontend\ViewAction;
use krok\system\components\frontend\Controller;
use yii\web\ErrorAction;

/**
 * Class DefaultController
 *
 * @package krok\content\controllers\frontend
 */
class DefaultController extends Controller
{
    /**
     * @return array
     */
    public function actions(): array
    {
        return [
            'index' => [
                'class' => ViewAction::class,
            ],
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }
}
