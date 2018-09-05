<?php

namespace krok\cabinet\models;

/**
 * This is the model class for table "{{%client_oauth}}".
 *
 * @property integer $id
 * @property integer $clientId
 * @property string $source
 * @property string $sourceId
 *
 * @property Client $clientRelation
 */
class OAuth extends \yii\db\ActiveRecord
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
        return '{{%client_oauth}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientId', 'source', 'sourceId'], 'required'],
            [['clientId'], 'integer'],
            [['source', 'sourceId'], 'string', 'max' => 128],
            [
                ['clientId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Client::className(),
                'targetAttribute' => ['clientId' => 'id'],
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
            'clientId' => 'Клиент',
            'source' => 'Источник',
            'sourceId' => 'ID источника',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientRelation()
    {
        return $this->hasOne(Client::className(), ['id' => 'clientId']);
    }

    /**
     * @inheritdoc
     * @return OAuthQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OAuthQuery(get_called_class());
    }
}
