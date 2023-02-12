<?php

namespace admin\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;


/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error','user-role','user','permision'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','t'],
                        'allow' => true,
                        //'roles' => ['@'],
                    ],
                    [
                        'actions' => ['admin'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['mod'],
                        'allow' => true,
                        'roles' => ['moderator'],
                    ],
                    [
                        'actions' => ['tenant'],
                        'allow' => true,
                        'roles' => ['tenant'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $r = Yii::$app->redis;
        $res = $r->set('1','aa777aa');
        var_dump($res);
        //return $this->render('index');
    }
    public function actionT()
    {
        $r = Yii::$app->redis;
        $res = $r->get('1');
        var_dump($res);
        //return $this->render('index');
    }


    public function actionAdmin()
    {
        echo 'Admin';
    }

    public function actionTenant()
    {
        echo 'Tenant';
    }

    public function actionSecurity()
    {
        echo 'Security';
    }
    public function actionMod()
    {
        echo 'Moderator';
    }


    public function actionPermision()
    {


        $auth = Yii::$app->authManager;

        $auth->removeAllPermissions(); 
        $auth->removeAllRules();

        $createTenant = $auth->createPermission('CreateTenant');
        $createTenant->description = 'Создать арендатора';
        $auth->add($createTenant);

        $browseTenant = $auth->createPermission('BrowseTenant');
        $browseTenant->description = 'Обзор арендатора';
        $auth->add($browseTenant);


        $updateTenant = $auth->createPermission('UpdateTenant');
        $updateTenant->description = 'Изменить арендатора';
        $auth->add($updateTenant);

        $deleteTenant = $auth->createPermission('DeleteTenant');
        $deleteTenant->description = 'Удалить арендатора';
        $auth->add($deleteTenant);


        $createUser = $auth->createPermission('CreateUser');
        $createUser->description = 'Создать пользователя';
        $auth->add($createUser);

        $browseUser = $auth->createPermission('BrowseUser');
        $browseUser->description = 'Обзор пользователя';
        $auth->add($browseUser);


        $updateUser = $auth->createPermission('UpdateUser');
        $updateUser->description = 'Изменить пользователя';
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('DeleteUser');
        $deleteUser->description = 'Удалить пользователя';
        $auth->add($deleteUser);


        $createEmployee = $auth->createPermission('CreateEmployee');
        $createEmployee->description = 'Создать сотрудника';
        $auth->add($createEmployee);

        $browseEmployee = $auth->createPermission('BrowseEmployee');
        $browseEmployee->description = 'Обзор сотрудника';
        $auth->add($browseEmployee);


        $updateEmployee = $auth->createPermission('UpdateEmployee');
        $updateEmployee->description = 'Изменить сотрудника';
        $auth->add($updateEmployee);

        $deleteEmployee = $auth->createPermission('DeleteEmployee');
        $deleteEmployee->description = 'Удалить сотрудника';
        $auth->add($deleteEmployee);

        $rule = new \common\rbac\TenantRule;
        $auth->add($rule);


        $createYourEmployee = $auth->createPermission('CreateYourEmployee');
        $createYourEmployee->description = 'Создать свою сотрудника';
        $createYourEmployee->ruleName = $rule->name; 
        $auth->add($createYourEmployee);

        $browseYourEmployee = $auth->createPermission('BrowseYourEmployee');
        $browseYourEmployee->description = 'Обзор свою сотрудника';
        $browseYourEmployee->ruleName = $rule->name; 
        $auth->add($browseYourEmployee);


        $updateYourEmployee = $auth->createPermission('UpdateYourEmployee');
        $updateYourEmployee->description = 'Изменить свою сотрудника';
        $updateYourEmployee->ruleName = $rule->name; 
        $auth->add($updateYourEmployee);

        $deleteYourEmployee = $auth->createPermission('DeleteYourEmployee');
        $deleteYourEmployee->description = 'Удалить свою сотрудника';
        $deleteYourEmployee->ruleName = $rule->name; 
        $auth->add($deleteYourEmployee);


        $browseSettings = $auth->createPermission('BrowseSettings');
        $browseSettings->description = 'Обзор настроек';
        $auth->add($browseSettings);

        $updateSettings = $auth->createPermission('UpdateSettings');
        $updateSettings->description = 'Изменить настроек';
        $auth->add($updateSettings);


        

    }

    public function actionUserRole()
    {


        $auth = Yii::$app->authManager;
        $auth->removeAllRoles();


        //Tenant
        $tenant = $auth->createRole('tenant');
        $auth->add($tenant);
        //Moderator
        $moderator = $auth->createRole('moderator');
        $auth->add($moderator);
        //Admin
        $admin = $auth->createRole('admin');
        $auth->add($admin); 
        
        
    }

    public function actionUserRole1()
    {
        /*
      
        $auth = Yii::$app->authManager;

        $createTenant = $auth->createPermission('CreateTenant');
        $createTenant->description = 'Создать арендатора';
        $auth->add($createTenant);

        $browseTenant = $auth->createPermission('BrowseTenant');
        $browseTenant->description = 'Обзор арендатора';
        $auth->add($browseTenant);


        $updateTenant = $auth->createPermission('UpdateTenant');
        $updateTenant->description = 'Изменить арендатора';
        $auth->add($updateTenant);

        $deleteTenant = $auth->createPermission('DeleteTenant');
        $deleteTenant->description = 'Удалить арендатора';
        $auth->add($deleteTenant);


        $createUser = $auth->createPermission('CreateUser');
        $createUser->description = 'Создать пользователя';
        $auth->add($createUser);

        $browseUser = $auth->createPermission('BrowseUser');
        $browseUser->description = 'Обзор пользователя';
        $auth->add($browseUser);


        $updateUser = $auth->createPermission('UpdateUser');
        $updateUser->description = 'Изменить пользователя';
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('DeleteUser');
        $deleteUser->description = 'Удалить пользователя';
        $auth->add($deleteUser);


        $createEmployee = $auth->createPermission('CreateEmployee');
        $createEmployee->description = 'Создать сотрудника';
        $auth->add($createEmployee);

        $browseEmployee = $auth->createPermission('BrowseEmployee');
        $browseEmployee->description = 'Обзор сотрудника';
        $auth->add($browseEmployee);


        $updateEmployee = $auth->createPermission('UpdateEmployee');
        $updateEmployee->description = 'Изменить сотрудника';
        $auth->add($updateEmployee);

        $deleteEmployee = $auth->createPermission('DeleteEmployee');
        $deleteEmployee->description = 'Удалить сотрудника';
        $auth->add($deleteEmployee);


    
        $rule = new \common\rbac\TenantRule;
        $auth->add($rule);


        $createYourEmployee = $auth->createPermission('CreateYourEmployee');
        $createYourEmployee->description = 'Создать свою сотрудника';
        $createYourEmployee->ruleName = $rule->name; 
        $auth->add($createYourEmployee);

        $browseYourEmployee = $auth->createPermission('BrowseYourEmployee');
        $browseYourEmployee->description = 'Обзор свою сотрудника';
        $browseYourEmployee->ruleName = $rule->name; 
        $auth->add($browseYourEmployee);


        $updateYourEmployee = $auth->createPermission('UpdateYourEmployee');
        $updateYourEmployee->description = 'Изменить свою сотрудника';
        $updateYourEmployee->ruleName = $rule->name; 
        $auth->add($updateYourEmployee);

        $deleteYourEmployee = $auth->createPermission('DeleteYourEmployee');
        $deleteYourEmployee->description = 'Удалить свою сотрудника';
        $deleteYourEmployee->ruleName = $rule->name; 
        $auth->add($deleteYourEmployee);


        $browseSettings = $auth->createPermission('BrowseSettings');
        $browseSettings->description = 'Обзор настроек';
        $auth->add($browseSettings);

        $updateSettings = $auth->createPermission('UpdateSettings');
        $updateSettings->description = 'Изменить настроек';
        $auth->add($updateSettings);

        //Tenant
     
        $tenant = $auth->createRole('tenant');
        //is_same_company

        $auth->add($tenant);

   
        $auth->addChild($tenant, $createYourEmployee);    
        $auth->addChild($tenant, $browseYourEmployee);    
        $auth->addChild($tenant, $updateYourEmployee);   
        $auth->addChild($tenant, $deleteYourEmployee);    
        
        //--
        
       


        //Moderator
        
        $moderator = $auth->createRole('moderator');
        $auth->add($moderator);
        

        $auth->addChild($moderator, $createEmployee);    
        $auth->addChild($moderator, $browseEmployee);    
        $auth->addChild($moderator, $updateEmployee);   
        $auth->addChild($moderator, $deleteEmployee);    

        $auth->addChild($moderator,  $createTenant);    
        $auth->addChild($moderator,  $browseTenant);    
        $auth->addChild($moderator,  $updateTenant); 
        $auth->addChild($moderator,  $deleteTenant);   
        
        $auth->addChild($moderator,$tenant);
        
        //--


        //Admin
        $admin = $auth->createRole('admin');
        $auth->add($admin); 
        
        $auth->addChild($admin,  $createUser);    
        $auth->addChild($admin,  $browseUser);    
        $auth->addChild($admin,  $updateUser); 
        $auth->addChild($admin,  $deleteUser);   

        $auth->addChild($admin,  $browseSettings);    
        $auth->addChild($admin,  $updateSettings);

        $auth->addChild($admin,$moderator);

        //--
        


  

        $user = new \common\models\User();
        $user->username = 'admin';
        $user->email = 'admin@mail.loc';
        $user->setPassword('123456');
        $user->generateAuthKey();
        $user->save(false);

        // нужно добавить следующие три строки:
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('admin');
        $auth->assign($authorRole, $user->getId());
        Yii::$app->user->logout();



        $user = new \common\models\User();
        $user->username = 'moderator';
        $user->email = 'moderator@mail.loc';
        $user->setPassword('123456');
        $user->generateAuthKey();
        $user->save(false);

        // нужно добавить следующие три строки:
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('moderator');
        $auth->assign($authorRole, $user->getId());
        Yii::$app->user->logout();


        $user = new \common\models\User();
        $user->username = 'tenant';
        $user->email = 'tenant@mail.loc';
        $user->setPassword('123456');
        $user->generateAuthKey();
        $user->save(false);

        // нужно добавить следующие три строки:
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('tenant');
        $auth->assign($authorRole, $user->getId());
        Yii::$app->user->logout();
        */
       // return $user;
     
 //       $cu = \Yii::$app->user->can('DeleteYourEmployee');
   //     var_dump($cu);
      //  Yii::$app->user->logout();
        echo 'Roles Created';
       

    }

    public function actionUser()
    {
        $r= \Yii::$app->user->logout();
        //$cu = Yii::$app->user->can('CreateTenant');
        //var_dump($cu);
       // return $this->render('user');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        //$this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
