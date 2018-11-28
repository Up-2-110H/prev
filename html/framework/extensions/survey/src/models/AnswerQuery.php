<?php

namespace krok\survey\models;

/**
 * This is the ActiveQuery class for [[Answer]].
 *
 * @see Answer
 */
class AnswerQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Answer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Answer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param int $id
     *
     * @return AnswerQuery
     */
    public function byQuestionId(int $id): AnswerQuery
    {
        return $this->andWhere([Answer::tableName() . '.[[questionId]]' => $id]);
    }

    /**
     * @param int $hidden
     *
     * @return AnswerQuery
     */
    public function hidden(int $hidden = Answer::HIDDEN_NO): AnswerQuery
    {
        return $this->andWhere([Answer::tableName() . '.[[hidden]]' => $hidden]);
    }

    /**
     * @param int $hidden
     *
     * @return AnswerQuery
     */
    public function onHidden(int $hidden = Answer::HIDDEN_NO): AnswerQuery
    {
        return $this->andOnCondition([Answer::tableName() . '.[[hidden]]' => $hidden]);
    }

    /**
     * @return AnswerQuery
     */
    public function orderByPosition(): AnswerQuery
    {
        return $this->orderBy([
            Answer::tableName() . '.[[position]]' => SORT_ASC,
            Answer::tableName() . '.[[id]]' => SORT_DESC,
        ]);
    }
}
