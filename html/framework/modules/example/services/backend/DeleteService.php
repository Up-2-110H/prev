<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 05.07.17
 * Time: 0:07
 */

namespace app\modules\example\services\backend;

use app\modules\example\interfaces\ExampleInterface;
use app\modules\example\interfaces\ExampleServiceInterface;

/**
 * Class DeleteService
 *
 * @package app\modules\example\services\backend
 */
class DeleteService implements ExampleServiceInterface
{
    /**
     * @var ExampleInterface|null
     */
    protected $model = null;

    /**
     * DeleteService constructor.
     *
     * @param ExampleInterface $model
     */
    public function __construct(ExampleInterface $model)
    {
        $this->model = $model;
    }

    /**
     * @return bool|int
     */
    public function execute()
    {
        return $this->model->delete();
    }
}
