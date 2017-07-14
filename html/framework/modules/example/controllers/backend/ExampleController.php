<?php

namespace app\modules\example\controllers\backend;

use app\modules\example\dto\backend\ViewDto;
use app\modules\example\forms\backend\CreateForm;
use app\modules\example\forms\backend\UpdateForm;
use app\modules\example\interfaces\ExampleSearchInterface;
use app\modules\example\services\backend\CreateService;
use app\modules\example\services\backend\DeleteService;
use app\modules\example\services\backend\FindService;
use app\modules\example\services\backend\SearchService;
use app\modules\example\services\backend\UpdateService;
use app\modules\system\components\backend\Controller;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * ExampleController implements the CRUD actions for Example model.
 */
class ExampleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Example models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = Yii::createObject(ExampleSearchInterface::class);
        $dataProvider = Yii::createObject(SearchService::class, [$searchModel])->execute();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Example model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $dto = Yii::createObject(ViewDto::class, [$model]);

        return $this->render('view', [
            'model' => $dto,
        ]);
    }

    /**
     * Creates a new Example model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $form = Yii::createObject(CreateForm::class);

        if ($form->load(Yii::$app->getRequest()->post())) {
            $model = Yii::createObject(CreateService::class, [$form])->execute();

            if ($model) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing Example model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $form = Yii::createObject(UpdateForm::class, [$model]);

        if ($form->load(Yii::$app->getRequest()->post())) {
            $result = Yii::createObject(UpdateService::class, [$model, $form])->execute();

            if ($result) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $form,
        ]);
    }

    /**
     * Deletes an existing Example model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        Yii::createObject(DeleteService::class, [$model])->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Example model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return object the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $service = Yii::createObject(FindService::class);

        if (($model = $service->execute()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
