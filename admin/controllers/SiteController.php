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
                        'actions' => ['login', 'error','user-role','user'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','t'],
                        'allow' => true,
                        //'roles' => ['@'],
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

    public function actionUserRole()
    {
        $auth = Yii::$app->authManager;

        $createTenant = $auth->createPermission('CreateTenant');
        $createTenant->description = 'Создать арендатора';
        $auth->add($createPost);

        $browseTenant = $auth->createPermission('BrowseTenant');
        $browseTenant->description = 'Обзор арендатора';
        $auth->add($updatePost);


        $updateTenant = $auth->createPermission('UpdateTenant');
        $updateTenant->description = 'Изменить арендатора';
        $auth->add($updatePost);

        $deleteTenant = $auth->createPermission('DeleteTenant');
        $deleteTenant->description = 'Удалить арендатора';
        $auth->add($updatePost);


        $createUser = $auth->createPermission('CreateUser');
        $createUser->description = 'Создать пользователя';
        $auth->add($createPost);

        $browseUser = $auth->createPermission('BrowseUser');
        $browseUser->description = 'Обзор пользователя';
        $auth->add($updatePost);


        $updateUser = $auth->createPermission('UpdateUser');
        $updateUser->description = 'Изменить пользователя';
        $auth->add($updatePost);

        $deleteUser = $auth->createPermission('DeleteUser');
        $deleteUser->description = 'Удалить пользователя';
        $auth->add($updatePost);


        $createEmployee = $auth->createPermission('CreateEmployee');
        $createEmployee->description = 'Создать сотрудника';
        $auth->add($createPost);

        $browseEmployee = $auth->createPermission('BrowseEmployee');
        $browseEmployee->description = 'Обзор сотрудника';
        $auth->add($updatePost);


        $updateEmployee = $auth->createPermission('UpdateEmployee');
        $updateEmployee->description = 'Изменить сотрудника';
        $auth->add($updatePost);

        $deleteEmployee = $auth->createPermission('DeleteEmployee');
        $deleteEmployee->description = 'Удалить сотрудника';
        $auth->add($updatePost);



        $createYourEmployee = $auth->createPermission('CreateYourEmployee');
        $createEmployee->description = 'Создать свою сотрудника';
        $auth->add($createYourEmployee);

        $browseYourEmployee = $auth->createPermission('BrowseYourEmployee');
        $browseEmployee->description = 'Обзор свою сотрудника';
        $auth->add($browseYourEmployee);


        $updateYourEmployee = $auth->createPermission('UpdateYourEmployee');
        $updateEmployee->description = 'Изменить свою сотрудника';
        $auth->add($updateYourEmployee);

        $deleteYourEmployee = $auth->createPermission('DeleteYourEmployee');
        $deleteEmployee->description = 'Удалить свою сотрудника';
        $auth->add($deleteYourEmployee);


        $browseSettings = $auth->createPermission('BrowseSettings');
        $browseSettings->description = 'Обзор настроек';
        $auth->add($updatePost);

        $updateSettings = $auth->createPermission('UpdateSettings');
        $updateSettings->description = 'Изменить настроек';
        $auth->add($updatePost);


        $tenant = $auth->createRole('tenant');
        $auth->add($tenant);
        
        //Tenant
        $auth->addChild($tenant, $createEmployee);    
        $auth->addChild($tenant, $browseEmployee);    
        $auth->addChild($tenant, $updateEmployee);   
        $auth->addChild($tenant, $deleteEmployee);    
        //


        $admin = $auth->createRole('admin');
        $auth->add($admin);
        //Admin
        $auth->addChild($admin,  $createTenant);    
        $auth->addChild($admin,  $browseTenant);    
        $auth->addChild($admin,  $updateTenant); 
        $auth->addChild($admin,  $deleteTenant);    
        
        $auth->addChild($admin,  $createUser);    
        $auth->addChild($admin,  $browseUser);    
        $auth->addChild($admin,  $updateUser); 
        $auth->addChild($admin,  $deleteUser);   

        $auth->addChild($admin,  $browseSettings);    
        $auth->addChild($admin,  $updateSettings);

        //


        //$auth->addChild($admin, $createPost);    






       







        // добавляем роль "author" и даём роли разрешение "createPost"
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
        //return $this->render('user-role');
    }

    public function actionUser()
    {
        return $this->render('user');
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
