<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 14:00
 */

namespace krok\survey\types;

use yii\db\Exception;

/**
 * Class RadioType
 *
 * @package krok\survey\types
 */
class RadioType extends Type
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
        return $this->render('radio', [
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
            if (in_array($answer->id, $answerIds)) {
                $model = $this->getModel();

                $model->setAttributes([
                    'surveyId' => $this->question->surveyId,
                    'questionId' => $this->question->id,
                    'answerId' => $answer->id,
                ]);

                if (!$model->save()) {
                    throw new Exception('Save failed');
                } else {
                    return;
                }
            }
        }
    }
}
