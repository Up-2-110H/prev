<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 14:01
 */

namespace krok\survey\types;

use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * Class SelectMultipleType
 *
 * @package krok\survey\types
 */
class SelectMultipleType extends Type
{
    /**
     * @return bool
     */
    public function isAnswers(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getForm(): string
    {
        $items = ArrayHelper::map($this->question->answersRelation, 'id', 'title');

        return $this->render('selectMultiple', [
            'model' => $this->question,
            'items' => $items,
        ]);
    }

    /**
     * @param array $answerIds
     *
     * @throws Exception
     */
    public function saveForm(array $answerIds)
    {
        foreach ($this->question->answersRelation as $answer) {
            if (in_array($answer->id, $answerIds)) {
                $model = $this->getModel();

                $model->setAttributes([
                    'surveyId' => $this->question->surveyId,
                    'questionId' => $this->question->id,
                    'answerId' => $answer->id,
                ]);

                if (!$model->save()) {
                    throw new Exception('Save failed');
                }
            }
        }
    }
}
