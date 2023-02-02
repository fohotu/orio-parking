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
        return $this->render('user-role');
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
