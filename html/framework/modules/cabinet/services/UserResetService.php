<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 22.06.17
 * Time: 11:49
 */

namespace app\modules\cabinet\services;

use app\modules\cabinet\components\AbstractReset;
use Yii;

/**
 * Class UserResetService
 *
 * @package app\modules\cabinet\services
 */
class UserResetService
{
    /**
     * @var null|AbstractReset
     */
    protected $user = null;

    /**
     * UserResetService constructor.
     *
     * @param AbstractReset $user
     */
    public function __construct(AbstractReset $user)
    {
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function execute()
    {
        if ($result = $this->user->validate()) {
            $model = $this->user->findByReset();
            $password = $this->user->password;

            $model->setAttribute('auth_key', Yii::$app->getSecurity()->generateRandomString(64));
            $model->setAttribute('access_token', Yii::$app->getSecurity()->generateRandomString(128));
            $model->setAttribute('reset_token', Yii::$app->getSecurity()->generateRandomString(128));
            $model->setAttribute('password', Yii::$app->getSecurity()->generatePasswordHash($password));

            $result = $model->save();
        }

        return $result;
    }
}
