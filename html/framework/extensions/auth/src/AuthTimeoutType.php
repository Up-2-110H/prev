<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 09.08.18
 * Time: 16:04
 */

namespace krok\auth;

use krok\configure\types\NumberType;

/**
 * Class AuthTimeoutType
 *
 * @package krok\auth
 */
class AuthTimeoutType extends NumberType
{
    /**
     * @return string
     */
    public function run()
    {
        $this->model->{$this->attribute} /= 60;

        return parent::run();
    }
}
