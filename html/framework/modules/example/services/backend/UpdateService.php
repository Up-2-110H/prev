<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 05.07.17
 * Time: 0:09
 */

namespace app\modules\example\services\backend;

use app\modules\example\interfaces\ExampleInterface;
use app\modules\example\interfaces\ExampleServiceInterface;

/**
 * Class UpdateService
 *
 * @package app\modules\example\services\backend
 */
class UpdateService implements ExampleServiceInterface
{
    /**
     * @var ExampleInterface|null
     */
    protected $model = null;

    /**
     * UpdateService constructor.
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
