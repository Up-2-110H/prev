<?php

namespace app\modules\example\models;

use app\behaviors\LanguageBehavior;
use app\behaviors\TimestampBehavior;
use app\interfaces\HiddenAttributeInterface;
use app\modules\example\interfaces\ExampleInterface;
use app\traits\HiddenAttributeTrait;

/**
 * This is the model class for table "{{%example}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $hidden
 * @property string $language
 * @property string $created_at
 * @property string $updated_at
 */
class Example extends \yii\db\ActiveRecord implements ExampleInterface, HiddenAttributeInterface
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
     * @return array
     */
    public function behaviors()
    {
        return [
            'LanguageBehavior' => [
                'class' => LanguageBehavior::className(),
                'attribute' => 'language',
            ],
            'TimestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
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
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['hidden'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
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
