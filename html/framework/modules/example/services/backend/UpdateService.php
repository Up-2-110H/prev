<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 05.07.17
 * Time: 0:09
 */

namespace app\modules\example\services\backend;

use app\modules\example\forms\backend\UpdateForm;
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
     * @var UpdateForm|null
     */
    protected $form = null;

    /**
     * UpdateService constructor.
     *
     * @param ExampleInterface $model
     * @param UpdateForm $form
     */
    public function __construct(ExampleInterface $model, UpdateForm $form)
    {
        $this->model = $model;
        $this->form = $form;
    }

    /**
     * @return bool
     */
    public function execute()
    {
        if ($result = $this->form->validate()) {
            $attributes = $this->form->getAttributes();
            $this->model->setAttributes($attributes);

            $result = $this->model->save();
        }

        return $result;
    }
}
