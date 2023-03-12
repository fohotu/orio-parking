<?php
namespace admin\controllers;

use Yii;
use admin\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class HomeController extends BaseController
{

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [],
        );
    }


    public function actionIndex()
    {
        return $this->render('index');
    }
}

?>