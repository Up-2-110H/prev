<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 05.02.16
 * Time: 20:58
 */

namespace krok\cabinet\components;

/**
 * Class User
 *
 * @package krok\cabinet\components
 */
class User extends \yii\web\User
{
    /**
     * @var string
     */
    public $idParam = '__id_client';

    /**
     * @var string
     */
    public $authTimeoutParam = '__expire_client';

    /**
     * @var string
     */
    public $absoluteAuthTimeoutParam = '__absoluteExpire_client';

    /**
     * @var string
     */
    public $returnUrlParam = '__returnUrl_client';
}
