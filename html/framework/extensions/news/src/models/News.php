<?php

namespace krok\news\models;

use krok\auth\models\Auth;
use krok\configure\ConfigureInterface;
use krok\extend\behaviors\CreatedByBehavior;
use krok\extend\interfaces\HiddenAttributeInterface;
use krok\extend\traits\HiddenAttributeTrait;
use krok\news\Configure;
use krok\news\traits\StorageTrait;
use krok\storage\behaviors\StorageBehavior;
use krok\storage\dto\StorageDto;
use krok\storage\interfaces\StorageInterface;
use League\Flysystem\FilesystemInterface;
use voskobovich\behaviors\ManyToManyBehavior;
use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $date
 * @property string $announce
 * @property string $text
 * @property integer $hidden
 * @property integer $createdBy
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Relation[] $groupRelation
 */
class News extends \yii\db\ActiveRecord implements HiddenAttributeInterface, StorageInterface
{
    use HiddenAttributeTrait;
    use StorageTrait;

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
            'StorageBehaviorImage' => [
                'class' => StorageBehavior::class,
                'attribute' => 'src',
                'scenarios' => [
                    self::SCENARIO_DEFAULT,
                ],
            ],
            'ManyToManyBehavior' => [
                'class' => ManyToManyBehavior::class,
                'relations' => [
                    'groupIds' => 'groupRelation',
                ],
            ],
            'CreatedByBehavior' => [
                'class' => CreatedByBehavior::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['date', 'createdAt', 'updatedAt'], 'safe'],
            [['announce'], 'string', 'max' => 2048],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 128],
            [
                ['createdBy'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Auth::className(),
                'targetAttribute' => ['createdBy' => 'id'],
            ],
            [['hidden', 'createdBy'], 'integer'],
            /**
             * virtual property
             */
            [['groupIds'], 'each', 'rule' => ['integer']],
            [
                ['src'],
                'image',
                'extensions' => [
                    'png',
                    'jpg',
                    'jpeg',
                    'gif',
                ],
                'skipOnEmpty' => true,
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
            'title' => 'Заголовок',
            'date' => 'Дата',
            'announce' => 'Анонс',
            'text' => 'Текст',
            'hidden' => 'Скрыто',
            'createdBy' => 'Создал',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
            /**
             * virtual property
             */
            'groupIds' => 'Группы новостей',
            'src' => 'Изображение',
        ];
    }

    /**
     * @return null|string
     */
    public function getPreview()
    {
        if ($this->src instanceof StorageDto) {
            $configurable = Yii::createObject(ConfigureInterface::class)->get(Configure::class);
            $filesystem = Yii::createObject(FilesystemInterface::class);

            return $filesystem->getPublicUrl($this->src->getSrc(), [
                'w' => $configurable->width,
                'h' => $configurable->height,
                'fit' => $configurable->fit,
            ]);
        }

        return null;
    }

    /**
     * @param string $separator
     *
     * @return string
     */
    public function getGroup(string $separator = ',<br >')
    {
        return implode($separator, array_column($this->groupRelation, 'title'));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupRelation()
    {
        return $this->hasMany(Group::class, ['id' => 'groupId'])
            ->viaTable(Relation::tableName(), ['newsId' => 'id']);
    }

    /**
     * @inheritdoc
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }
}
