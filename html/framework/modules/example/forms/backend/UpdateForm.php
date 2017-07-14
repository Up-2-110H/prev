<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 09.07.17
 * Time: 12:17
 */

namespace app\modules\example\forms\backend;

use app\interfaces\HiddenAttributeInterface;
use app\modules\example\interfaces\ExampleInterface;
use app\traits\HiddenAttributeTrait;
use DateTime;
use Yii;
use yii\base\Model;

/**
 * Class UpdateForm
 *
 * @package app\modules\example\forms\backend
 */
class UpdateForm extends Model implements HiddenAttributeInterface
{
    use HiddenAttributeTrait;

    /**
     * @var integer
     */
    private $id;

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
     * UpdateForm constructor.
     *
     * @param ExampleInterface $model
     * @param array $config
     */
    public function __construct(ExampleInterface $model, array $config = [])
    {
        Yii::configure($this, $model->getAttributes());
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'text'], 'required'],
            [['id'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['text'], 'string'],
            [['hidden'], 'integer'],
            [['updated_at'], 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'id',
            'title',
            'text',
            'hidden',
            'updatedAt',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'text' => 'Текст',
            'hidden' => 'Скрыто',
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
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
    public function getText(): string
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
    public function getHidden(): int
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
        return $this->language;
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
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        $this->updatedAt = (new DateTime())->format('Y-m-d H:i:s');

        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}
