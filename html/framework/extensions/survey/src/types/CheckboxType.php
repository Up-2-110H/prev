<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 6:29
 */

namespace krok\survey\types;

use yii\db\Exception;

/**
 * Class CheckboxType
 *
 * @package krok\survey\types
 */
class CheckboxType extends Type
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
        return $this->render('checkbox', [
            'model' => $this->question,
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
            if (array_key_exists($answer->id, $answerIds)) {
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
