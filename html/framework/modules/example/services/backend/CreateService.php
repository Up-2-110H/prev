<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 04.07.17
 * Time: 22:41
 */

namespace app\modules\example\services\backend;

use app\modules\example\forms\backend\CreateForm;
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
     * @var CreateForm|null
     */
    protected $form = null;

    /**
     * @var ExampleInterface|null
     */
    protected $model = null;

    /**
     * CreateService constructor.
     *
     * @param CreateForm $form
     * @param ExampleInterface $model
     */
    public function __construct(CreateForm $form, ExampleInterface $model)
    {
        $this->form = $form;
        $this->model = $model;
    }

    /**
     * @return ExampleInterface|bool|null
     */
    public function execute()
    {
        if ($result = $this->form->validate()) {
            $attributes = $this->form->getAttributes();
            $this->model->setAttributes($attributes, false);

            if ($result = $this->model->save()) {
                return $this->model;
            }
        }

        return $result;
    }
}
