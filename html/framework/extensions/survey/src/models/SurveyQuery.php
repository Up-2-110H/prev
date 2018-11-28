<?php

namespace krok\survey\models;

use Yii;
use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[Survey]].
 *
 * @see Survey
 */
class SurveyQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Survey[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Survey|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param int $id
     *
     * @return SurveyQuery
     */
    public function byId(int $id): SurveyQuery
    {
        return $this->andWhere([Survey::tableName() . '.[[id]]' => $id]);
    }

    /**
     * @return SurveyQuery
     */
    public function active(): SurveyQuery
    {
        return $this->joinWith([
            'questionsRelation' => function (QuestionQuery $query) {
                $query->onHidden()->orderByPosition();
                $query->joinWith([
                    'answersRelation' => function (AnswerQuery $query) {
                        $query->onHidden()->orderByPosition();
                    },
                ]);
            },
        ])->hidden()->language();
    }

    /**
     * @param int $hidden
     *
     * @return SurveyQuery
     */
    public function hidden(int $hidden = Survey::HIDDEN_NO): SurveyQuery
    {
        return $this->andWhere([Survey::tableName() . '.[[hidden]]' => $hidden]);
    }

    /**
     * @param string|null $language
     *
     * @return SurveyQuery
     */
    public function language(string $language = null): SurveyQuery
    {
        if ($language === null) {
            $language = Yii::$app->language;
        }

        return $this->andWhere([Survey::tableName() . '.[[language]]' => $language]);
    }

    /**
     * @return SurveyQuery
     */
    public function orderByRandom(): SurveyQuery
    {
        return $this->orderBy(new Expression('RAND()'));
    }
}
