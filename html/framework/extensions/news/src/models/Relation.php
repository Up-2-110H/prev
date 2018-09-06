<?php

namespace krok\news\models;

/**
 * This is the model class for table "{{%news_relation}}".
 *
 * @property integer $id
 * @property integer $newsId
 * @property integer $groupId
 *
 * @property Group $groupRelation
 * @property News $newsRelation
 */
class Relation extends \yii\db\ActiveRecord
{
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
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newsId', 'groupId'], 'integer'],
            [['newsId', 'groupId'], 'required'],
            [
                ['groupId'],
                'exist',
                'skipOnError' => false,
                'targetClass' => Group::className(),
                'targetAttribute' => ['groupId' => 'id'],
            ],
            [
                ['newsId'],
                'exist',
                'skipOnError' => false,
                'targetClass' => News::className(),
                'targetAttribute' => ['newsId' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'newsId' => 'Новость',
            'groupId' => 'Группа',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupRelation()
    {
        return $this->hasOne(Group::className(), ['id' => 'groupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsRelation()
    {
        return $this->hasOne(News::className(), ['id' => 'newsId']);
    }

    /**
     * @inheritdoc
     * @return RelationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RelationQuery(get_called_class());
    }
}
