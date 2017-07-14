<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 14.07.17
 * Time: 17:01
 */

namespace app\interfaces;

/**
 * Interface ModelInterface
 *
 * @package app\interfaces
 */
interface ModelInterface
{
    /**
     * @param null $names
     * @param array $except
     *
     * @return array
     */
    public function getAttributes($names = null, $except = []);

    /**
     * @param array $values
     * @param bool $safeOnly
     *
     * @return mixed
     */
    public function setAttributes($values, $safeOnly = true);
}
