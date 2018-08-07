<?php

namespace krok\content\models;

use Yii;

/**
 * This is the ActiveQuery class for [[Content]].
 *
 * @see Content
 */
class ContentQuery extends \yii\db\ActiveQuery
{
    /**
     * @param string $alias
     *
     * @return ContentQuery
     */
    public function byAlias(string $alias): ContentQuery
    {
        return $this->andWhere([Content::tableName() . '.[[alias]]' => $alias]);
    }

    /**
     * @param int $hidden
     *
     * @return ContentQuery
     */
    public function hidden(int $hidden = Content::HIDDEN_NO): ContentQuery
    {
        return $this->andWhere([Content::tableName() . '.[[hidden]]' => $hidden]);
    }

    /**
     * @param string|null $language
     *
     * @return ContentQuery
     */
    public function language(string $language = null): ContentQuery
    {
        if ($language === null) {
            $language = Yii::$app->language;
        }

        return $this->andWhere([Content::tableName() . '.[[language]]' => $language]);
    }

    /**
     * @inheritdoc
     * @return Content[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Content|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
