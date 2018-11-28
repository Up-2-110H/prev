<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.11.18
 * Time: 15:57
 */

namespace krok\survey\controllers\frontend;

use krok\survey\actions\frontend\ErrorAction;
use krok\survey\actions\frontend\IndexAction;
use krok\survey\actions\frontend\ResultAction;
use krok\survey\actions\frontend\SendAction;
use krok\system\components\frontend\Controller;

/**
 * Class DefaultController
 *
 * @package krok\survey\controllers\frontend
 */
class DefaultController extends Controller
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class,
            ],
            'send' => [
                'class' => SendAction::class,
            ],
            'result' => [
                'class' => ResultAction::class,
            ],
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }
}
