<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 22.06.17
 * Time: 11:47
 */

namespace app\modules\cabinet\services;

use app\modules\cabinet\components\AbstractConfirm;
use Yii;

/**
 * Class UserConfirmService
 *
 * @package app\modules\cabinet\services
 */
class UserConfirmService
{
    /**
     * @var null|AbstractConfirm
     */
    protected $user = null;

    /**
     * UserConfirmService constructor.
     *
     * @param AbstractConfirm $user
     */
    public function __construct(AbstractConfirm $user)
    {
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function execute()
    {
        if ($result = $this->user->validate()) {
            return Yii::$app
                ->getMailer()
                ->compose('@app/modules/cabinet/mail/confirm.php', [
                    'model' => $this->user->findByConfirm(),
                ])
                ->setSubject('Изменение пароля в Личном кабинете')
                ->setFrom(Yii::$app->params['email'])
                ->setTo($this->user->email)
                ->send();
        }

        return $result;
    }
}
