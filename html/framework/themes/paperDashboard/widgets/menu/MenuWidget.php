<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 06.06.17
 * Time: 14:44
 */

namespace app\themes\paperDashboard\widgets\menu;

use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Class MenuWidget
 *
 * @package app\themes\paperDashboard\widgets\menu
 */
class MenuWidget extends Widget
{
    /**
     * @var array
     */
    public $items = [];

    /**
     * @return string
     */
    public function run()
    {
        return $this->renderItems($this->items);
    }

    /**
     * @param array $items
     *
     * @return string
     */
    public function renderItems(array $items)
    {
        return Html::ul($items, [
            'class' => 'nav',
            'item' => function ($item, $index) {

                $label = ArrayHelper::getValue($item, 'label');
                $url = ArrayHelper::getValue($item, 'url');
                $icon = ArrayHelper::getValue($item, 'icon', 'ti-package');
                $items = ArrayHelper::getValue($item, 'items', null);

                if (is_array($items)) {
                    $caret = Html::tag('b', '', ['class' => 'caret']);
                    $options = [
                        'data-toggle' => 'collapse',
                        'href' => '#menu-' . $index,
                    ];
                    $collapse = Html::tag('div', $this->renderItems($items),
                        ['class' => 'collapse', 'id' => 'menu-' . $index]);
                } else {
                    $caret = '';
                    $options = [
                        'href' => Url::to($url),
                    ];
                    $collapse = '';
                }

                $content = Html::tag('i', '', ['class' => $icon]) . Html::tag('p', $label . $caret);

                return Html::tag('li', Html::a($content, null, $options) . $collapse);
            },
        ]);
    }
}
