<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 13:58
 */

namespace krok\survey\types;

use yii\db\Exception;

/**
 * Class NumberType
 *
 * @package krok\survey\types
 */
class NumberType extends Type
{
    /**
     * @return bool
     */
    public function isAnswers(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function getForm(): string
    {
        return $this->render('number', [
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
        $answer = array_shift($answerIds);
        $model = $this->getModel();
        $model->setAttributes([
            'surveyId' => $this->question->surveyId,
            'questionId' => $this->question->id,
            'value' => (string)intval($answer),
        ]);

        if (!$model->save()) {
            throw new Exception('Save failed');
        }
    }
}
