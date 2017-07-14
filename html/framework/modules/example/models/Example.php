<?php

namespace app\modules\example\models;

use app\interfaces\HiddenAttributeInterface;
use app\modules\example\interfaces\ExampleInterface;
use app\traits\HiddenAttributeTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%example}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $hidden
 * @property string $language
 * @property string $createdAt
 * @property string $updatedAt
 */
class Example extends ActiveRecord implements ExampleInterface, HiddenAttributeInterface
{
    use HiddenAttributeTrait;

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%example}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['hidden'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['language'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'hidden' => 'Скрыто',
            'language' => 'Язык',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
        ];
    }

    /**
     * @inheritdoc
     * @return ExampleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExampleQuery(get_called_class());
    }
}
