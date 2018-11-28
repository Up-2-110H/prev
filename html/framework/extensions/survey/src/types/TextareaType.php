<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 6:28
 */

namespace krok\survey\types;

use yii\db\Exception;
use yii\helpers\Html;

/**
 * Class TextareaType
 *
 * @package krok\survey\types
 */
class TextareaType extends Type
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
        return $this->render('textarea', [
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
            'value' => Html::encode($answer),
        ]);

        if (!$model->save()) {
            throw new Exception('Save failed');
        }
    }
}
