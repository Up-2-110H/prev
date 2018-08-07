<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 07.08.18
 * Time: 12:23
 */

namespace krok\content\actions\frontend;

use krok\content\dto\frontend\ContentDto;
use krok\content\models\Content;
use krok\meta\MetaInterface;
use Yii;
use yii\base\Action;
use yii\caching\TagDependency;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class ViewAction
 *
 * @package krok\content\actions\frontend
 */
class ViewAction extends Action
{
    /**
     * @var MetaInterface
     */
    protected $meta;

    /**
     * ViewAction constructor.
     *
     * @param string $id
     * @param Controller $controller
     * @param MetaInterface $meta
     * @param array $config
     */
    public function __construct(string $id, Controller $controller, MetaInterface $meta, array $config = [])
    {
        parent::__construct($id, $controller, $config);

        $this->meta = $meta;
    }

    /**
     * @param string $alias
     *
     * @return string
     */
    public function run(string $alias = 'index'): string
    {
        $model = $this->find($alias);
        $this->meta->register($model);

        $dto = Yii::createObject(ContentDto::class, [$model]);

        $this->controller->layout = $dto->getLayout();

        return $this->controller->render($dto->getView(), ['dto' => $dto]);
    }

    /**
     * @param string $alias
     *
     * @return Content
     * @throws NotFoundHttpException
     */
    protected function find(string $alias): Content
    {
        $key = [
            __CLASS__,
            __FILE__,
            __LINE__,
            $alias,
            Yii::$app->language,
        ];

        $dependency = new TagDependency([
            'tags' => [
                Content::class,
            ],
        ]);

        $model = Yii::$app->getCache()->get($key);

        if ($model === false) {
            $model = Content::find()->byAlias($alias)->hidden()->language()->one();
            Yii::$app->getCache()->set($key, $model, 1 * 60 * 60, $dependency);
        }

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $model;
    }
}
