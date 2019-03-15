<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 11.08.17
 * Time: 22:25
 */

namespace krok\content\dto\frontend;

use krok\content\models\Content;

/**
 * Class ContentDto
 *
 * @package krok\content\dto\frontend
 */
class ContentDto
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $layout;

    /**
     * @var string
     */
    protected $view;

    /**
     * @var string|null
     */
    protected $createdAt;

    /**
     * @var string|null
     */
    protected $updatedAt;

    /**
     * ContentDto constructor.
     *
     * @param Content $model
     */
    public function __construct(Content $model)
    {
        $this->id = $model->id;
        $this->alias = $model->alias;
        $this->title = $model->title;
        $this->text = $model->text;
        $this->layout = $model->layout;
        $this->view = $model->view;
        $this->createdAt = $model->createdAt;
        $this->updatedAt = $model->updatedAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getLayout(): string
    {
        return $this->layout;
    }

    /**
     * @return string
     */
    public function getView(): string
    {
        return $this->view;
    }

    /**
     * @return null|string
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @return null|string
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}
