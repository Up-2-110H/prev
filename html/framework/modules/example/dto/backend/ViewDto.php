<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 09.07.17
 * Time: 11:51
 */

namespace app\modules\example\dto\backend;

use app\modules\example\interfaces\ExampleInterface;

/**
 * Class ViewDto
 *
 * @package app\modules\example\dto\backend
 */
class ViewDto
{
    /**
     * @var ExampleInterface|null
     */
    protected $model = null;

    /**
     * ViewDto constructor.
     *
     * @param ExampleInterface $model
     */
    public function __construct(ExampleInterface $model)
    {
        $this->model = $model;
    }

    public function getId()
    {
        return $this->model->getAttribute('id');
    }

    public function getTitle()
    {
        return $this->model->getAttribute('title');
    }

    public function getText()
    {
        return $this->model->getAttribute('text');
    }

    public function getHidden()
    {
        return $this->model->getAttribute('hidden');
    }

    public function getCreatedAt()
    {
        return $this->model->getAttribute('createdAt');
    }

    public function getUpdatedAt()
    {
        return $this->model->getAttribute('updatedAt');
    }
}
