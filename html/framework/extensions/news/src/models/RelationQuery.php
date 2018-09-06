<?php

namespace krok\news\models;

/**
 * This is the ActiveQuery class for [[Relation]].
 *
 * @see Relation
 */
class RelationQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Relation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Relation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
