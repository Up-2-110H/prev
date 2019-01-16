<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 10.08.18
 * Time: 13:28
 */

namespace krok\auth\components;

use krok\auth\Configurable;
use krok\configure\ConfigureInterface;

/**
 * Class User
 *
 * @package krok\auth\components
 */
class User extends \yii\web\User
{
    /**
     * @var Configurable
     */
    protected $configurable;

    /**
     * User constructor.
     *
     * @param ConfigureInterface $configurable
     * @param array $config
     */
    public function __construct(ConfigureInterface $configurable, array $config = [])
    {
        parent::__construct($config);

        $this->configurable = $configurable->get(Configurable::class);

        $this->authTimeout = $this->authTimeout ?: $this->configurable->authTimeout;
    }
}
