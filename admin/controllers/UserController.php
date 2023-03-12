<?php

namespace admin\controllers;

use Yii;
use common\models\User;
use common\models\form\UserForm;
use common\models\form\ChangePasswordForm;
use common\models\form\ChangeRoleForm;
use common\models\search\UserSearch;
use common\service\UserService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{


    private $service;

    public function __construct($id, $module, $config = [],UserService $service)
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
                
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],
                
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UserForm();

        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                //var_dump($model->attributes);exit;
                $r=$this->service->create($model->attributes);
                var_dump($r);
            }
        } 

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($this->request->isPost && $model->profile->load($this->request->post()) && $model->profile->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update',[
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    public function actionChangePassword($u)
    {
        $passwordForm = new ChangePasswordForm;

        if(Yii::$app->request->isPost){
            if($passwordForm->load(Yii::$app->request->post()) &&  $passwordForm->validate()){
                $user = $this->findModel($u);
                $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($passwordForm->password);
                if($user->save())
                    return $this->redirect(['index']);
            }
        }

        return $this->render('change_password',[
            'passwordForm' => $passwordForm,
        ]);
    }

    public function actionChangeRole($u)
    {
        $auth = Yii::$app->authManager;
        $roleForm = new ChangeRoleForm;
        $roles = Yii::$app->authManager->getRoles();
        $userRole = $auth->getRolesByUser($u);
        if(Yii::$app->request->isPost){
            if($roleForm->load(Yii::$app->request->post()) &&  $roleForm->validate()){
                $user = $this->findModel($u);
                $auth->revokeAll($user->id);
                $newRole = $auth->getRole($roleForm->role);
                $auth->assign($newRole, $user->id);
                return $this->redirect(['index']);
            }
        }

        return $this->render('change_role',[
            'roleForm' => $roleForm,
            'roles' => $roles,
            'userRole' => $userRole,
        ]);
    }


    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
