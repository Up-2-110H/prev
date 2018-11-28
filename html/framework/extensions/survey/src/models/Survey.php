<?php

namespace krok\survey\models;

use krok\extend\behaviors\LanguageBehavior;
use krok\extend\behaviors\TagDependencyBehavior;
use krok\extend\behaviors\TimestampBehavior;
use krok\extend\interfaces\HiddenAttributeInterface;
use krok\extend\traits\HiddenAttributeTrait;

/**
 * This is the model class for table "{{%survey}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $hidden
 * @property string $language
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Question[] $questionsRelation
 */
class Survey extends \yii\db\ActiveRecord implements HiddenAttributeInterface
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
            'TagDependencyBehavior' => [
                'class' => TagDependencyBehavior::class,
            ],
            'LanguageBehavior' => [
                'class' => LanguageBehavior::class,
            ],
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%survey}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'hidden'], 'required'],
            [['hidden'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['title'], 'string', 'max' => 256],
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
            'title' => 'Название',
            'hidden' => 'Скрыто',
            'language' => 'Язык',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsRelation()
    {
        return $this->hasMany(Question::className(), ['surveyId' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SurveyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SurveyQuery(get_called_class());
    }
}
