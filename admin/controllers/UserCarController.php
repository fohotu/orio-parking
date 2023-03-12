<?php

namespace admin\controllers;

use common\models\UserCar;
use common\models\form\UserCarForm;
use common\models\search\UserCarSearch;
use common\service\UserCarService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserCarController implements the CRUD actions for UserCar model.
 */
class UserCarController extends BaseController
{

    private $service;

    public function __construct($id, $module, $config = [],UserCarService $service)
    {
        parent::__construct($id, $module,$config);
        $this->service = $service;
    }
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all UserCar models.
     *
     * @return string
     */
    public function actionIndex($id)
    {
        $model = new UserCarForm();
        $model->user_id = $id;

        $searchModel = new UserCarSearch();
        $searchModel->user_id = $id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }

    /**
     * Displays a single UserCar model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserCar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {

        $model = new UserCarForm();
        $model->user_id = $id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                $save = $this->service->create($model->attributes);
                return $this->redirect(['index', 'id' => $id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'id' => $id,
        ]);
    }

    /**
     * Updates an existing UserCar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $formModel = new UserCarForm;
        $formModel->user_id = $model->user_id;

        if ($this->request->isPost && $formModel->load($this->request->post()) && $formModel->validate()) {
            //var_dump($formModel->attributes);
            $this->service->update($model->car_id,$id,$formModel->attributes);
            return $this->redirect(['index', 'id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'formModel' => $formModel,
        ]);
    }

    public function actionAjaxUpdate($id)
    {

        $model = $this->findModel($id);
        $formModel = new UserCarForm;
        $formModel->user_id = $model->user_id;

        if ($this->request->isPost && $formModel->load($this->request->post()) && $formModel->validate()) {
            $this->service->update($model->car_id,$formModel->attributes);
            return $this->redirect(['index', 'id' => $model->user_id]);
        }

        return $this->renderPartial('update', [
            'model' => $model,
            'formModel' => $formModel,
        ]);
    }

    /**
     * Deletes an existing UserCar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $urlId= $model->user_id;
        $model->delete();

        return $this->redirect(['index','id'=>$urlId]);
    }

    /**
     * Finds the UserCar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return UserCar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserCar::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
