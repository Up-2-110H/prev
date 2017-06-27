<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.06.17
 * Time: 0:02
 */

namespace app\modules\cabinet\form;

use app\modules\cabinet\models\Client;

/**
 * Class CreateForm
 *
 * @package app\modules\cabinet\form
 */
class CreateForm extends Client
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email_verify', 'blocked'], 'integer'],
            [['login'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['email'], 'string', 'max' => 64],
            [['login', 'email'], 'unique'],
            [['email'], 'email'],
            [['login', 'password'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Электронная почта',
            'email_verify' => 'Электронная почта подтверждена',
            'blocked' => 'Заблокирован',
        ];
    }
}
