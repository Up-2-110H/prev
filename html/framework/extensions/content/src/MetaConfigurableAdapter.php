<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 07.08.18
 * Time: 15:40
 */

namespace krok\content;

use krok\content\models\Content;
use krok\meta\strategies\ComposeStrategy;
use krok\meta\strategies\StrategyInterface;
use yii\di\Instance;

/**
 * Class MetaConfigurableAdapter
 *
 * @package krok\content
 */
class MetaConfigurableAdapter extends \krok\meta\adapters\MetaConfigurableAdapter
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
                'title' => function (Content $model) use ($configurable) {
                    return implode($configurable->separator, array_diff([
                        $this->title ?: $model->title,
                        $configurable->title,
                    ], ['']));
                },
            ],
        ], StrategyInterface::class);

        return $strategy;
    }
}
