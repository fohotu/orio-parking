<?php 

namespace console\controllers;

use yii\console\Controller;

use yii\helpers\Console;

class CommandController extends Controller
{
    public $message;
    
    public function options($actionID)
    {
        return ['message'];
    }
    
    public function optionAliases()
    {
        return ['m' => 'message'];
    }
    
    public function actionIndex()
    {
        $this->stdout("Hello", Console::BOLD);
    }
    
}


?>