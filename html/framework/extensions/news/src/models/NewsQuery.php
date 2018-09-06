<?php

namespace krok\news\models;

use DateTime;

/**
 * This is the ActiveQuery class for [[News]].
 *
 * @see News
 */
class NewsQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return News[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return News|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param int $hidden
     *
     * @return $this
     */
    public function hidden(int $hidden = News::HIDDEN_NO)
    {
        $this->andWhere([News::tableName() . '.[[hidden]]' => $hidden]);

        return $this;
    }

    /**
     * @param int|null $createdBy
     *
     * @return $this
     */
    public function createdBy(?int $createdBy = null)
    {
        $this->andWhere([News::tableName() . '.[[createdBy]]' => $createdBy]);

        return $this;
    }

    /**
     * @param null|string $date
     *
     * @return $this
     */
    public function coming(?string $date = null)
    {
        if ($date === null) {
            $date = (new DateTime())->format('Y-m-d H:i:s');
        }

        $this->andwhere(['<', News::tableName() . '.[[date]]', $date]);

        return $this;
    }

    /**
     * @return $this
     */
    public function order()
    {
        $this->orderBy([
            News::tableName() . '.[[date]]' => SORT_DESC,
            News::tableName() . '.[[id]]' => SORT_DESC,
        ]);

        return $this;
    }

    /**
     * @return $this
     */
    public function list()
    {
        $this->joinWith([
            'groupRelation' => function (GroupQuery $query) {
                $query->hidden();
                $query->language();
            },
        ]);

        return $this;
    }

    /**
     * @param int $id
     *
     * @return News|null
     */
    public function byId(int $id)
    {
        return $this->andwhere([News::tableName() . '.[[id]]' => $id])->joinWith([
            'groupRelation' => function (GroupQuery $query) {
                $query->hidden();
                $query->language();
            },
        ])->hidden()->one();
    }
}
