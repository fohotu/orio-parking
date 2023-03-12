<?php

namespace admin\controllers;

use Yii;
use common\models\Tenant;
use common\models\search\TenantSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\form\EmployeeForm;
use yii\filters\AccessControl;

/**
 * RoleController implements the CRUD actions for  model.
 */
class RoleController extends BaseController
{

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
                           // 'actions'=>['index'],
                            'roles' =>['admin'],// ['BrowseSettings','UpdateSettings'],
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

    public function actionTest()
    {

        $r= Yii::$app->user->logout();
        $user = \common\models\User::findOne(3);
        Yii::$app->user->login($user);
        $cu = Yii::$app->user->can('BrowseSettings');
        var_dump($cu);    
    }

    public function actionCreate()
    {
        $model = new \common\models\form\RoleForm;
        
        if(Yii::$app->request->isPost){
            if($model->load(Yii::$app->request->post()) && $model->validate()){
                $auth = Yii::$app->authManager;

                $newRole = $auth->createRole($model->name);
                $newRole->description = $model->displayname;
                $auth->add($newRole);

                $this->redirect(['index']);
            }
        }
        
        return $this->render('create',['model'=>$model]);
    }

    public function actionDelete($role)
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $auth = Yii::$app->authManager;
            $roleAuth = $auth->getRole($role);
            if($roleAuth){
                $auth->remove($roleAuth);
                $this->redirect(['index']);
            }
        }
    }

    public function actionEdit($role)
    {
        $modelForm = new \common\models\form\RoleForm;
        $model = Yii::$app->authManager->getRole($role);
        $modelForm->displayname = $model->description;
        $modelForm->name = $model->name;

        if(Yii::$app->request->isPost){
            if($modelForm->load(Yii::$app->request->post()) && $modelForm->validate()){
                $auth = Yii::$app->authManager;
                $model->description = $modelForm->displayname;
                $model->name = $modelForm->name;
                
                $r = $auth->update($role,$model);
                if($r)
                $this->redirect(['index']);
            }
        }
        
        return $this->render('edit',['model'=>$model,'modelForm'=>$modelForm]);
    }


    public function actionIndex()
    {
        $model = Yii::$app->authManager->getRoles();
        return $this->render('index',['model'=>$model]);
    }

    public function actionPermission()
    {   

        $auth = Yii::$app->authManager;
    

        $roles = $auth->getRoles();
        $permissions = $auth->getPermissions();
        $rolePermissions = [];
        


        foreach($roles as $role){ 
            $rolePermission = $auth->getPermissionsByRole($role->name);
            foreach($rolePermission as $k=>$v){
                $rolePermissions[$role->name][$k]=true;    
            }
        }

        if(Yii::$app->request->isPost){

    
            $post = Yii::$app->request->post('role');
            
            if(!$post){ 
                foreach($roles as $item){
                    $auth->removeChildren($item);
                    $this->redirect(['index']);
                }
            };

            if(!empty($post)){

                foreach($post as $key=>$value){

                    $role = $auth->getRole($key);
                    
                    foreach($roles as $item){
                        $check = isset($post[$item->name]);
                        if(!$check){
                            $auth->removeChildren($item);
                        }
                    }
                    

                    if($role){
                        $r = $auth->removeChildren($role); 
                        foreach($value as $k=>$item){
                            $permission = $auth->getPermission($k);
                            $auth->addChild($role,$permission);    
                            }
                        }
                
                    $this->redirect(['permission']);
                    
                }
            }

        }
        return $this->render('permission',['roles'=>$roles,'permissions'=>$permissions,'rolePermissions'=>$rolePermissions]);
    
    }

}

?>


