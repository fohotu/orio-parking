<?php 
namespace common\service;

use Yii;
use common\models\Profile;
use common\models\Employee;
use common\models\Car;

class UserCarService extends BaseService implements ServiceInterface{


    public function createOnOrion()
    {
        return true;
    }

    public function create($data)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            $time = time();
            $db->createCommand()->insert('car',[
               'car_number'=>$data['car_number'],
               'car_model' => $data['car_model'],
               'car_color' => $data['car_color'],
               'car_vin' => $data['car_vin'],
               'created_by' =>1,
                'created_at' => $time,
               'updated_at' => $time,
            ])->execute();
            
            $carId = $db->getLastInsertID();
            $db->createCommand()->insert('user_car',[
                'user_id' => $data['user_id'],
                'car_id' => $carId,
                'user_type' => 'employee',
                'start_date' => $this->mkTimeFromStr($data['start_date']),
                'end_date' => $this->mkTimeFromStr($data['end_date']),
             ])->execute();
            
            
            $transaction->commit();

            return $carId;

        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

    }


    public function update($id,$car_relation_id,$data){

        $db = Yii::$app->db;

        $transaction = $db->beginTransaction();

        try {

            $db->createCommand()->update('car', 
            [
                'car_number' => $data['car_number'],
                'car_model' => $data['car_model'],
                'car_color' => $data['car_color'],
                'car_vin' => $data['car_vin'],
            ], 
            'id = '.$id)->execute();

            $db->createCommand()->update('user_car',[
                'start_date' => $this->mkTimeFromStr($data['start_date']),
                'end_date' => $this->mkTimeFromStr($data['end_date']),
            ],'id ='.$car_relation_id)->execute();

            $transaction->commit();
            
        } catch (\Throwable $th) {
             $transaction->rollBack();
        }


      
        return true;
        
    }

}