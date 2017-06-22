<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 22.06.17
 * Time: 12:44
 */

namespace app\modules\cabinet\components;

use yii\base\Model;

/**
 * Class AbstractConfirm
 *
 * @package app\modules\cabinet\components
 */
abstract class AbstractConfirm extends Model implements ConfirmInterface
{
    /**
     * @var null
     */
    public $email = null;

    /**
     * @var null
     */
    public $verifyCode = null;
}
