<?php

namespace admin\controllers;

use Yii;
use common\models\Employee;
use common\models\Tenant;
use common\models\search\EmployeeSearch;
use common\models\form\EmployeeForm;
use common\service\EmployeeService;
use admin\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends BaseController
{
        
    private $service;

    public function __construct($id, $module, $config = [],EmployeeService $service)
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
     * Lists all Employee models.
     *
     * @return string
     */
    public function actionIndex($id)
    { 
        $searchModel = new EmployeeSearch();
        $searchModel->tenant_id = $id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
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
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($tenant)
    {
        $tenantModel = Tenant::findOne($tenant);
        if(!$tenantModel){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
      

        $model = new EmployeeForm();
        $model->tenant_id = $tenantModel->id;

        if ($this->request->isPost) {
            if($model->load($this->request->post()) && $model->validate()){
                $saved = $this->service->create($model->attributes);
                if($saved){    
                    return $this->redirect(['index', 'id' => $tenant]);
                }
            }
        } 

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = Employee::find()->where(['id'=>$id])->with([
            'car',
            'profile',
            'userParking'
        ])->one();
        
        if($this->request->isPost){
            $this->service->update($model,$this->request->post());
            $this->redirect(['employee/index','id'=>$model->tenant_id]);
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
        
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
