<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 04.07.17
 * Time: 23:49
 */

namespace app\modules\example\services\backend;

use app\modules\example\interfaces\ExampleInterface;
use app\modules\example\interfaces\ExampleServiceInterface;

/**
 * Class FindService
 *
 * @package app\modules\example\services\backend
 */
class FindService implements ExampleServiceInterface
{
    /**
     * @var ExampleInterface|null
     */
    protected $model = null;

    /**
     * FindService constructor.
     *
     * @param ExampleInterface $model
     */
    public function __construct(ExampleInterface $model)
    {
        $this->model = $model;
    }

    /**
     * @return \yii\db\ActiveQueryInterface
     */
    public function execute()
    {
        return $this->model::find();
    }
}
