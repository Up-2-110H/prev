<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 26.11.18
 * Time: 6:42
 */

namespace krok\survey\types;

use krok\survey\models\Question;
use krok\survey\models\Result;
use ReflectionClass;
use Yii;
use yii\base\ViewContextInterface;
use yii\web\View;

/**
 * Class Type
 *
 * @package krok\survey\types
 */
abstract class Type implements TypeInterface, ViewContextInterface
{
    /**
     * @var Question
     */
    protected $question;

    /**
     * @var View
     */
    private $view;

    /**
     * Type constructor.
     *
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * @return Result
     */
    public function getModel(): Result
    {
        return new Result();
    }

    /**
     * @param string $view
     * @param array $params
     *
     * @return string
     */
    public function render(string $view, array $params = []): string
    {
        return $this->getView()->render($view, $params, $this);
    }

    /**
     * @return View
     */
    public function getView(): View
    {
        if ($this->view === null) {
            $this->view = Yii::$app->getView();
        }

        return $this->view;
    }

    /**
     * @return string
     */
    public function getViewPath(): string
    {
        $class = new ReflectionClass($this);

        return dirname($class->getFileName()) . DIRECTORY_SEPARATOR . 'views';
    }
}
