<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 07.08.18
 * Time: 16:10
 */

namespace krok\content;

use krok\content\models\Content;
use krok\meta\strategies\ComposeStrategy;
use krok\meta\strategies\StrategyInterface;
use yii\di\Instance;

/**
 * Class OpenGraphConfigurableAdapter
 *
 * @package krok\content
 */
class OpenGraphConfigurableAdapter extends \krok\meta\adapters\OpenGraphConfigurableAdapter
{
    /**
     * @return StrategyInterface
     */
    public function getStrategy(): StrategyInterface
    {
        $configurable = $this->getConfigurable();

        /** @var StrategyInterface $strategy */
        $strategy = Instance::ensure([
            'class' => ComposeStrategy::class,
            'compose' => [
                'og:title' => function (Content $model) use ($configurable) {
                    return $this->title ?: $model->title;
                },
            ],
        ], StrategyInterface::class);

        return $strategy;
    }
}
