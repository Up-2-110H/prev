<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 06.06.17
 * Time: 18:17
 */

namespace app\themes\paperDashboard\widgets\grid;

use Yii;
use yii\grid\ActionColumn;
use yii\helpers\Html;

/**
 * Class ActionColumnWidget
 *
 * @package app\themes\paperDashboard\widgets\grid
 */
class ActionColumnWidget extends ActionColumn
{
    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'ti-user');
        $this->initDefaultButton('update', 'ti-pencil-alt');
        $this->initDefaultButton('delete', 'ti-close', [
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
        ]);
    }

    /**
     * @param string $name
     * @param string $iconClass
     * @param array $additionalOptions
     */
    protected function initDefaultButton($name, $iconClass, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconClass, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                    'rel' => 'tooltip',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('i', '', ['class' => $iconClass]);

                return Html::a($icon, $url, $options);
            };
        }
    }
}
