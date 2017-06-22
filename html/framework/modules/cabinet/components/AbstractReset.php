<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 22.06.17
 * Time: 12:59
 */

namespace app\modules\cabinet\components;

use yii\base\Model;

/**
 * Class AbstractReset
 *
 * @package app\modules\cabinet\components
 */
abstract class AbstractReset extends Model implements ResetInterface
{
    /**
     * @var null
     */
    public $password = null;

    /**
     * @var null
     */
    public $token = null;

    /**
     * @var null
     */
    public $verifyCode = null;
}
