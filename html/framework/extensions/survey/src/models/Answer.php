<?php

namespace krok\survey\models;

use krok\extend\behaviors\TagDependencyBehavior;
use krok\extend\behaviors\TimestampBehavior;
use krok\extend\interfaces\HiddenAttributeInterface;
use krok\extend\traits\HiddenAttributeTrait;

/**
 * This is the model class for table "{{%survey_answer}}".
 *
 * @property integer $id
 * @property integer $questionId
 * @property string $title
 * @property integer $hidden
 * @property integer $position
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Question $questionRelation
 */
class Answer extends \yii\db\ActiveRecord implements HiddenAttributeInterface
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
        return '{{%survey_answer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['questionId', 'title', 'hidden'], 'required'],
            [['questionId', 'hidden', 'position'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['title'], 'string', 'max' => 256],
            [
                ['questionId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Question::className(),
                'targetAttribute' => ['questionId' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'questionId' => 'Вопрос',
            'title' => 'Ответ',
            'hidden' => 'Скрыто',
            'position' => 'Позиция',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionRelation()
    {
        return $this->hasOne(Question::className(), ['id' => 'questionId']);
    }

    /**
     * @inheritdoc
     * @return AnswerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnswerQuery(get_called_class());
    }
}
