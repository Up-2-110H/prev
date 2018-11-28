<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 27.11.18
 * Time: 15:58
 */

namespace krok\survey\actions\frontend;

use krok\survey\models\Answer;
use krok\survey\models\Question;
use krok\survey\models\Survey;
use Yii;
use yii\base\Action;
use yii\caching\TagDependency;

/**
 * Class IndexAction
 *
 * @package krok\survey\actions\frontend
 */
class IndexAction extends Action
{
    /**
     * @var string
     */
    public $view = 'index';

    /**
     * @return string
     */
    public function run()
    {
        $key = [
            __CLASS__,
            __FILE__,
            __LINE__,
            Yii::$app->language,
        ];

        $dependency = new TagDependency([
            'tags' => [
                Survey::class,
                Question::class,
                Answer::class,
            ],
        ]);

        $models = Yii::$app->getCache()->get($key);

        if ($models === false) {
            $models = Survey::find()->active()->orderByRandom()->limit(10)->all();
            Yii::$app->getCache()->set($key, $models, 1 * 60 * 60, $dependency);
        }

        shuffle($models);

        return $this->controller->render($this->view, [
            'model' => array_shift($models),
        ]);
    }
}
