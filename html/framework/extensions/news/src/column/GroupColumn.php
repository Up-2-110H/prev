<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 06.09.18
 * Time: 15:21
 */

namespace krok\news\column;

use krok\news\models\Group;
use krok\news\models\News;
use yii\grid\DataColumn;

/**
 * Class GroupColumn
 *
 * @package krok\news\column
 */
class GroupColumn extends DataColumn
{
    /**
     * @var string
     */
    public $attribute = 'groupIds';

    /**
     * @var string
     */
    public $format = 'html';

    /**
     * @var array
     */
    public $filterInputOptions = [
        'class' => 'form-control',
        'multiple' => true,
    ];

    /**
     * @param mixed $model
     * @param mixed $key
     * @param int $index
     *
     * @return string
     */
    public function getDataCellValue($model, $key, $index)
    {
        if ($this->value === null) {
            if ($model instanceof News) {
                return $model->getGroup();
            }
        }

        return parent::getDataCellValue($model, $key, $index);
    }

    /**
     * @return string
     */
    protected function renderFilterCellContent()
    {
        if ($this->filter === null) {
            $filterModel = $this->grid->filterModel;
            if ($filterModel instanceof News) {
                $this->filter = Group::find()->asDropDown();
            }
        }

        return parent::renderFilterCellContent();
    }
}
