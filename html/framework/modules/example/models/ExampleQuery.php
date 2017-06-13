<?php

namespace app\modules\example\models;

use Yii;

/**
 * This is the ActiveQuery class for [[Example]].
 *
 * @see Example
 */
class ExampleQuery extends \yii\db\ActiveQuery
{
    /**
     * @param null|string $language
     *
     * @return $this
     */
    public function language($language = null)
    {
        if ($language === null) {
            $language = Yii::$app->language;
        }

        return $this->andWhere([Example::tableName() . '.[[language]]' => $language]);
    }

    /**
     * @inheritdoc
     * @return Example[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Example|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
