<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 6:15
 */

namespace krok\survey\types;

use yii\db\Exception;

/**
 * Interface TypeInterface
 *
 * @package krok\survey\types
 */
interface TypeInterface
{
    /**
     * @return bool
     */
    public function isAnswers(): bool;

    /**
     * @return string
     */
    public function getForm(): string;

    /**
     * @param array $answerIds
     *
     * @throws Exception
     */
    public function saveForm(array $answerIds);
}
