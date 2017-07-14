<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 07.07.17
 * Time: 18:30
 */

namespace app\modules\example\forms\backend;

use app\interfaces\HiddenAttributeInterface;
use app\traits\HiddenAttributeTrait;
use DateTime;
use Yii;
use yii\base\Model;

/**
 * Class CreateForm
 *
 * @package app\modules\example\forms
 */
class CreateForm extends Model implements HiddenAttributeInterface
{
    use HiddenAttributeTrait;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $text;

    /**
     * @var integer
     */
    private $hidden;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $updatedAt;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['hidden'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['language'], 'string', 'max' => 8],
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'title',
            'text',
            'hidden',
            'language',
            'createdAt',
            'updatedAt',
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
            'text' => 'Текст',
            'hidden' => 'Скрыто',
            'language' => 'Язык',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getHidden(): ?int
    {
        return $this->hidden;
    }

    /**
     * @param int $hidden
     */
    public function setHidden(int $hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language ?: Yii::$app->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        $this->createdAt = (new DateTime())->format('Y-m-d H:i:s');

        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        $this->updatedAt = (new DateTime())->format('Y-m-d H:i:s');

        return $this->updatedAt;
    }
}
