<?php

namespace krok\news\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the ActiveQuery class for [[Group]].
 *
 * @see Group
 */
class GroupQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Group[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Group|array|null
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
    public function hidden(int $hidden = Group::HIDDEN_NO)
    {
        $this->andWhere([Group::tableName() . '.[[hidden]]' => $hidden]);

        return $this;
    }

    /**
     * @param null|string $language
     *
     * @return $this
     */
    public function language(?string $language = null)
    {
        if ($language === null) {
            $language = Yii::$app->language;
        }

        $this->andWhere([Group::tableName() . '.[[language]]' => $language]);

        return $this;
    }

    /**
     * @return array
     */
    public function asDropDown(): array
    {
        return ArrayHelper::map($this->asArray()->all(), 'id', 'title');
    }
}
