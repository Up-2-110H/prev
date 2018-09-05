<?php

namespace krok\cabinet\models;

use yii\helpers\ArrayHelper;

/**
 * This is the ActiveQuery class for [[Client]].
 *
 * @see Client
 */
class ClientQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Client[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Client|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return array
     */
    public function asDropDown()
    {
        return ArrayHelper::map($this->asArray()->all(), 'id', 'login');
    }
}
