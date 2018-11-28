<?php

namespace krok\survey\models;

use krok\extend\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%survey_result}}".
 *
 * @property integer $id
 * @property integer $surveyId
 * @property integer $questionId
 * @property integer $answerId
 * @property string $value
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Answer $answerRelation
 * @property Question $questionRelation
 * @property Survey $surveyRelation
 */
class Result extends \yii\db\ActiveRecord
{
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
        return '{{%survey_result}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['surveyId', 'questionId'], 'required'],
            [['surveyId', 'questionId', 'answerId'], 'integer'],
            [['value'], 'string'],
            [['createdAt', 'updatedAt'], 'safe'],
            [
                ['answerId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Answer::className(),
                'targetAttribute' => ['answerId' => 'id'],
            ],
            [
                ['questionId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Question::className(),
                'targetAttribute' => ['questionId' => 'id'],
            ],
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
            'questionId' => 'Вопрос',
            'answerId' => 'Ответ',
            'value' => 'Значение',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswerRelation()
    {
        return $this->hasOne(Answer::className(), ['id' => 'answerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionRelation()
    {
        return $this->hasOne(Question::className(), ['id' => 'questionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyRelation()
    {
        return $this->hasOne(Survey::className(), ['id' => 'surveyId']);
    }

    /**
     * @inheritdoc
     * @return ResultQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResultQuery(get_called_class());
    }
}
