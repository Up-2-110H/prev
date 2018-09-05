<?php

namespace krok\cabinet\models;

use krok\extend\behaviors\IpBehavior;
use krok\extend\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%client_log}}".
 *
 * @property integer $id
 * @property integer $clientId
 * @property integer $status
 * @property integer $ip
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Client $clientRelation
 */
class Log extends \yii\db\ActiveRecord
{
    const STATUS_LOGGED = 1;
    const STATUS_LOGOUT = 2;

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
            'IpBehavior' => [
                'class' => IpBehavior::class,
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
        return '{{%client_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientId', 'status', 'ip'], 'integer'],
            [['status'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
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
            'status' => 'Статус',
            'ip' => 'IP',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
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
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_LOGGED => 'Вход',
            self::STATUS_LOGOUT => 'Выход',
        ];
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return ArrayHelper::getValue(self::getStatusList(), $this->status);
    }

    /**
     * @inheritdoc
     * @return LogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogQuery(get_called_class());
    }
}
