<?php 

namespace service\commands;

use yii\console\Controller;

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
        echo 1212;//$this->message . "\n";
    }

    public function actionAddCar()
    {
        

       $data_from_orion_soap = \common\models\Dummy::getEvents(102);  
       $length = Yii::$app->redis->llen('parkingList');
        $all = Yii::$app->redis->lrange('parkingList',0,$length-1);
        foreach($data_from_orion_soap as $k=>$v){
            $not_serilized = $v;
            $ser_v = serialize($v);
            if(!in_array($ser_v,$all)){
                if($k > 1){
                    echo "has"."</br>";
                    $v->hasDb = 1234;
                }else{
                    echo "has not"."</br>";
                    $v->hasDb = 0;
                }
                //var_dump($v);
                $ser_v = serialize($not_serilized);
                /*
                    checkDb();
                    db bormi ?
                    agar bosa
                    $v->hasDb=true;//set_car_id
                    bo'mas 
                    $v->hasDb = false;//rangi qizil
                    qayta serializatsiya qilamiz ;
                */
                Yii::$app->redis->rpush('parkingList',$ser_v);
            }
        }

    }

    public function actionRemoveExpire()
    {
        $length = Yii::$app->redis->llen('parkingList');
        $all = Yii::$app->redis->lrange('parkingList',0,$length-1);
        Yii::$app->redis->del('parkingList');

        $two_day = 1;
        foreach($all as $k=>$v){
            $unser_v = unserialize($v);
            if($unser_v->EventDate > $two_day ){
                Yii::$app->redis->rpush('parkingList',$v); 
            }
        }
        
    }
}

?>