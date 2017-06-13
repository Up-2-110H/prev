<?php

namespace app\modules\example\models;

use app\behaviors\LanguageBehavior;
use app\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

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
class Example extends \yii\db\ActiveRecord
{
    const HIDDEN_NO = 0;
    const HIDDEN_YES = 1;

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
     * @return array
     */
    public static function getHiddenList()
    {
        return [
            self::HIDDEN_NO => 'Нет',
            self::HIDDEN_YES => 'Да',
        ];
    }

    /**
     * @return mixed
     */
    public function getHidden()
    {
        return ArrayHelper::getValue(self::getHiddenList(), $this->hidden);
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
