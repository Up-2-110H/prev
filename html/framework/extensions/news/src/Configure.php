<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 06.09.18
 * Time: 15:02
 */

namespace krok\news;

use krok\configure\ConfigurableInterface;
use krok\configure\types\DropDownType;
use yii\base\Model;

/**
 * Class Configure
 *
 * @package krok\news
 */
class Configure extends Model implements ConfigurableInterface
{
    const FIT_CONTAIN = 'contain';
    const FIT_CROP = 'crop';
    const FIT_STRETCH = 'stretch';
    const FIT_FILL = 'fill';
    const FIT_MAX = 'max';

    /**
     * @var integer
     */
    public $width = 200;

    /**
     * @var integer
     */
    public $height = 200;

    /**
     * @var string
     */
    public $fit = self::FIT_CONTAIN;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['width'], 'integer'],
            [['height'], 'integer'],
            [['fit'], 'string'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'width' => 'Ширина',
            'height' => 'Высота',
            'fit' => 'Действие',
        ];
    }

    /**
     * @return string
     */
    public static function label(): string
    {
        return 'Изображения у новостей';
    }

    /**
     * @return array
     */
    public static function attributeTypes(): array
    {
        return [
            'width' => 'number',
            'height' => 'number',
            'fit' => [
                'class' => DropDownType::class,
                'config' => [
                    'items' => static::getFitsList(),
                ],
            ],
        ];
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function populate(array $data): bool
    {
        return $this->load($data);
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public static function getFitsList()
    {
        return [
            self::FIT_CONTAIN => 'Сохранять пропорции',
            self::FIT_CROP => 'Обрезать',
            self::FIT_STRETCH => 'Растянуть',
            self::FIT_FILL => 'Заполнить',
            self::FIT_MAX => 'Максимально адаптировать',
        ];
    }
}
