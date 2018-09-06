<?php

namespace krok\news\models;

use krok\extend\behaviors\CreatedByBehavior;
use krok\extend\behaviors\LanguageBehavior;
use krok\extend\behaviors\TimestampBehavior;
use krok\extend\interfaces\HiddenAttributeInterface;
use krok\extend\traits\HiddenAttributeTrait;

/**
 * This is the model class for table "{{%news_group}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $language
 * @property integer $hidden
 * @property integer $createdBy
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Relation[] $newsRelation
 */
class Group extends \yii\db\ActiveRecord implements HiddenAttributeInterface
{
    use HiddenAttributeTrait;

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'LanguageBehavior' => [
                'class' => LanguageBehavior::class,
            ],
            'CreatedByBehavior' => [
                'class' => CreatedByBehavior::class,
            ],
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['hidden', 'createdBy'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['language'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'language' => 'Язык',
            'hidden' => 'Скрыто',
            'createdBy' => 'Создал',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsRelation()
    {
        return $this->hasMany(News::class, ['id' => 'newsId'])
            ->viaTable(Relation::tableName(), ['groupId' => 'id']);
    }

    /**
     * @inheritdoc
     * @return GroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupQuery(get_called_class());
    }
}
