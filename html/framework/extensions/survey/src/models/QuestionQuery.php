<?php

namespace krok\survey\models;

/**
 * This is the ActiveQuery class for [[Question]].
 *
 * @see Question
 */
class QuestionQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Question[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Question|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param int $id
     *
     * @return QuestionQuery
     */
    public function bySurveyId(int $id): QuestionQuery
    {
        return $this->andWhere([Question::tableName() . '.[[surveyId]]' => $id]);
    }

    /**
     * @param int $hidden
     *
     * @return QuestionQuery
     */
    public function hidden(int $hidden = Question::HIDDEN_NO): QuestionQuery
    {
        return $this->andWhere([Question::tableName() . '.[[hidden]]' => $hidden]);
    }

    /**
     * @param int $hidden
     *
     * @return QuestionQuery
     */
    public function onHidden(int $hidden = Question::HIDDEN_NO): QuestionQuery
    {
        return $this->andOnCondition([Question::tableName() . '.[[hidden]]' => $hidden]);
    }

    /**
     * @return QuestionQuery
     */
    public function orderByPosition(): QuestionQuery
    {
        return $this->orderBy([
            Question::tableName() . '.[[position]]' => SORT_ASC,
            Question::tableName() . '.[[id]]' => SORT_DESC,
        ]);
    }
}
