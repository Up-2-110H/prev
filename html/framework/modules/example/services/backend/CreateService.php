<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 04.07.17
 * Time: 22:41
 */

namespace app\modules\example\services\backend;

use app\modules\example\interfaces\ExampleInterface;
use app\modules\example\interfaces\ExampleServiceInterface;

/**
 * Class CreateService
 *
 * @package app\modules\example\services\backend
 */
class CreateService implements ExampleServiceInterface
{
    /**
     * @var ExampleInterface|null
     */
    protected $model = null;

    /**
     * CreateService constructor.
     *
     * @param ExampleInterface $model
     */
    public function __construct(ExampleInterface $model)
    {
        $this->model = $model;
    }

    /**
     * @return bool
     */
    public function execute()
    {
        return $this->model->save(false);
    }
}
