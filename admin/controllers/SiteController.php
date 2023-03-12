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

    public $enableCsrfValidation = false;
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
                        'actions' => ['login', 'error','user-role','user','permision','sd','gd','change-user'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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


    public function actionSd(){
        $k = md5('123456');
        $k = mt_rand(99,999);
        //$data = serialize([1,2,3,4,5,'test']);
        $r = Yii::$app->redis;
        //$r->set('parking:'.$k,$data);
       // $r->del('parking');
       // $r->del('parkingList');
        $r->rpush('parkingList',$k);
    }

    public function actionGd(){
        $k = md5('123456');
        $r = Yii::$app->redis;
        if($r->exists($k)){
            var_dump($r->get($k));
        }



        /*
        
        $companys = $client->GetCompanies(true,false);
        $result = $companys->OpertionResult;
        if(!empty($result) && is_array($result)){
            $lastId = $result[count($result)-1]->Id;
        }else{
            $lastId = 0
        }

        $obj = new stdClass;
        $obj->Id = $lastId;
        $obj->Name = "Test Air";
        $obj->Address = "Moscow"; 
        $obj->Phone = "12345";
         
        $r = $client->CreateCompany($obj);
        
        

        */


        //
   //     AddCar(car, token)
     //   TOperationResult<TCar> 
        
        /*
        
        $obj = new stdClass;
        $obj->Id = $lastId;
        $obj->Model = "";
        $obj->Color = "";
        $obj->Number = "";
        $obj->Vin = "";

        */
        
        //
      //  AddPersonCar()
      //  TOperationResult<TCar> AddPersonCar(car, person, token)


      /*
        
       $obj = new stdClass;
        $obj->Id = $lastId->Id;
        $obj->LastName = "Тимуров";
        $obj->FirstName = "Тимур";
        $obj->MiddleName = "Тимурович";
        $obj->BirthDate="2000-12-30T00:00:00.000+03:00";
        $obj->Company = 0;
        $obj->Department = 0;
        $obj->Position = 0;
        $obj->CompanyId = 0;
        $obj->DepartmentId = 0;
        $obj->PositionId = 0;
        $obj->TabNum = 1;
        $obj->Phone = 0;
        $obj->HomePhone = 0;
        $obj->Address = 0;
        $obj->Photo = null;
        $obj->AccessLevelId = 1;
        $obj->Status = 1;
        $obj->ContactIdIndex = 0;
        $obj->IsLockedDayCrossing = false;
        $obj->IsFreeShedule = false;
        $obj->ExternalId = 0;
        $obj->IsInArchive = false;
        $obj->DocumentType = 0;
        $obj->DocumentSerials = 0;
        $obj->DocumentNumber = 0;
        $obj->DocumentIssueDate = "2024-12-30T00:00:00.000+03:00";
        $obj->DocumentEndingDate = "2024-12-30T00:00:00.000+03:00";
        $obj->DocumentIsser = 0;
        $obj->DocumentIsserCode = 0;
        $obj->Sex = 0;
        $obj->Birthplace = "";
        $obj->EmailList = "";
        $obj->ArchivingTimeStamp = "2024-12-30T00:00:00.000+03:00";
        $obj->IsInBlackList = false;
        $obj->IsDismissed = false;
        $obj->ChangeTime = "";
        $obj->Itn = "";
        $obj->DismissedComment = "";
        $obj->BlackListComment = "";

      */  

      /*

      $obj = new stdClass;
      $obj->Id = "int";
      $obj->Model = "string";
      $obj->Color = "string";
      $obj->Number = "string";
      $obj->Vin = "string";

      */

    /*
        
        $time = time();
$start = $time - 365*24*3600;
$end = $time + 2*365*24*3600;
$num = "У790ЕВ791";
 $person = $client->GetPersonById(110);
//$client->PutPassWithEntryPoints($person);
//var_dump($person);
//exit;
$ac = $client->PutPassWithAccLevels($num,$person->OperationResult,[$al->OperationResult],$start,$end,"",5);
        
    */



        $persons = $client->GetPersons();
     
        
        $personList = $persons->OperationResult;
        $lastId = $personList[count($personList)-1];
        
        $obj = new stdClass;
        $obj->Id = $lastId->Id;
        $obj->LastName = "Тимуров";
        $obj->FirstName = "Тимур";
        $obj->MiddleName = "Тимурович";
        $obj->BirthDate="2000-12-30T00:00:00.000+03:00";
        $obj->Company = 0;
        $obj->Department = 0;
        $obj->Position = 0;
        $obj->CompanyId = 0;
        $obj->DepartmentId = 0;
        $obj->PositionId = 0;
        $obj->TabNum = 1;
        $obj->Phone = 0;
        $obj->HomePhone = 0;
        $obj->Address = 0;
        $obj->Photo = null;
        $obj->AccessLevelId = 1;
        $obj->Status = 1;
        $obj->ContactIdIndex = 0;
        $obj->IsLockedDayCrossing = false;
        $obj->IsFreeShedule = false;
        $obj->ExternalId = 0;
        $obj->IsInArchive = false;
        $obj->DocumentType = 0;
        $obj->DocumentSerials = 0;
        $obj->DocumentNumber = 0;
        $obj->DocumentIssueDate = "2024-12-30T00:00:00.000+03:00";
        $obj->DocumentEndingDate = "2024-12-30T00:00:00.000+03:00";
        $obj->DocumentIsser = 0;
        $obj->DocumentIsserCode = 0;
        $obj->Sex = 0;
        $obj->Birthplace = "";
        $obj->EmailList = "";
        $obj->ArchivingTimeStamp = "2024-12-30T00:00:00.000+03:00";
        $obj->IsInBlackList = false;
        $obj->IsDismissed = false;
        $obj->ChangeTime = "";
        $obj->Itn = "";
        $obj->DismissedComment = "";
        $obj->BlackListComment = "";
      
        $client->AddPerson($obj);


    }

    public function actionIndex()
    {
        $r = Yii::$app->redis;

        $data = [
            "44"=>"dfd",
            "441"=>"dfd1",
            "442"=>"dfd3",
            "443"=>"dfd4",
        ];

        $key = time(); 

        $sr = serialize($data);
        $res = $r->set($key,$sr);
        
        var_dump($res);
        //return $this->render('index');
    }
    public function actionT()
    {
        $r = Yii::$app->redis;
        $res = $r->get('d');
        $us = unserialize($res);
        var_dump($us);
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
        
        //[C877XE77] Выезд

        $command  = new stdClass();
        $command->ItemType = "RECOGNITION_CHANNEL";
        $command->ItemId = 0;
        $command->TimeStamp = "2023-02-24T12:05:55.000+03:00";
        $items [] = $command; 
        $rc = $client->ControlItems($items, 0);
        var_dump($rc);


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

    public function actionChangeUser()
    {
      
        $model = new LoginForm();
        $role = Yii::$app->request->post('role');

        if($role == 'a'){
            $data['username'] = 'admin';       
            $data['password'] = '123456';      
        }else if($role == 'm'){

            $data['username'] = 'moderator';       
            $data['password'] = '123456';

        }else{

            $data['username'] = 'tenant';       
            $data['password'] = '123456';
        }
        
        $model = \common\models\User::findByUsername($data['username']);
        if (Yii::$app->user->login($model)) {
           return $this->redirect(['history']);
        } 

    }

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
