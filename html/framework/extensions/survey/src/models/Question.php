<?php

namespace krok\survey\models;

use krok\extend\behaviors\TagDependencyBehavior;
use krok\extend\behaviors\TimestampBehavior;
use krok\extend\interfaces\HiddenAttributeInterface;
use krok\extend\traits\HiddenAttributeTrait;
use krok\survey\types\TypeInterface;
use Yii;

/**
 * This is the model class for table "{{%survey_question}}".
 *
 * @property integer $id
 * @property integer $surveyId
 * @property string $type
 * @property string $title
 * @property string $hint
 * @property integer $hidden
 * @property integer $position
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Survey $surveyRelation
 * @property Answer[] $answersRelation
 */
class Question extends \yii\db\ActiveRecord implements HiddenAttributeInterface
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
        return '{{%survey_question}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['surveyId', 'type', 'title', 'hint', 'hidden'], 'required'],
            [['surveyId', 'hidden', 'position'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['type', 'title', 'hint'], 'string', 'max' => 256],
            [
                ['surveyId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Survey::className(),
                'targetAttribute' => ['surveyId' => 'id'],
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
            'surveyId' => 'Опрос',
            'type' => 'Тип',
            'title' => 'Вопрос',
            'hint' => 'Подсказка',
            'hidden' => 'Скрыто',
            'position' => 'Позиция',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
        ];
    }

    /**
     * @return TypeInterface
     */
    public function createType(): TypeInterface
    {
        /** @var TypeInterface $type */
        $type = Yii::createObject($this->type, [
            $this,
        ]);

        return $type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyRelation()
    {
        return $this->hasOne(Survey::className(), ['id' => 'surveyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswersRelation()
    {
        return $this->hasMany(Answer::className(), ['questionId' => 'id']);
    }

    /**
     * @inheritdoc
     * @return QuestionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuestionQuery(get_called_class());
    }
}
