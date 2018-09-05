<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 25.02.16
 * Time: 12:08
 */

namespace krok\cabinet\components;

use krok\cabinet\models\Log;
use yii\db\Exception;
use yii\web\UserEvent;

/**
 * Class ClientEventHandler
 *
 * @package krok\cabinet\components
 */
class ClientEventHandler
{
    /**
     * @param UserEvent $event
     *
     * @throws Exception
     */
    public static function handleAfterLogin(UserEvent $event)
    {
        $model = new Log([
            'clientId' => $event->identity->getId(),
            'status' => Log::STATUS_LOGGED,
        ]);
        if (!$model->save()) {
            throw new Exception('Ошибка записи в журнал', $model->getErrors());
        }
    }

    /**
     * @param UserEvent $event
     *
     * @throws Exception
     */
    public static function handleAfterLogout(UserEvent $event)
    {
        $model = new Log([
            'clientId' => $event->identity->getId(),
            'status' => Log::STATUS_LOGOUT,
        ]);
        if (!$model->save()) {
            throw new Exception('Ошибка записи в журнал', $model->getErrors());
        }
    }
}
