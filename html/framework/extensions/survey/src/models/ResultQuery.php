<?php

namespace krok\survey\models;

/**
 * This is the ActiveQuery class for [[Result]].
 *
 * @see Result
 */
class ResultQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Result[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Result|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
