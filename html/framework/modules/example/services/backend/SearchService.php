<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 05.07.17
 * Time: 0:12
 */

namespace app\modules\example\services\backend;

use app\modules\example\interfaces\ExampleSearchInterface;
use app\modules\example\interfaces\ExampleServiceInterface;

/**
 * Class SearchService
 *
 * @package app\modules\example\services\backend
 */
class SearchService implements ExampleServiceInterface
{
    /**
     * @var ExampleSearchInterface|null
     */
    protected $model = null;

    /**
     * SearchService constructor.
     *
     * @param ExampleSearchInterface $model
     */
    public function __construct(ExampleSearchInterface $model)
    {
        $this->model = $model;
    }

    /**
     * @return \yii\data\ActiveDataProvider
     */
    public function execute()
    {
        return $this->model->search();
    }
}
