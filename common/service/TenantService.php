<?php 
namespace common\service;

use Yii;
use common\models\Profile;
use common\models\Employee;
use common\models\Car;

class TenantService extends BaseService implements ServiceInterface{




    public function create($data)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            $time = time();
            $db->createCommand()->insert('tenant',[
               'tenant_name'=>$data['tenant_name'],
               'tin' => $data['tin'],
               'bic' => $data['bic'],
               'checking_account' => $data['checking_account'],
               'address' => $data['address'],
               'bank_name' => $data['bank_name'],
               'cost_per_hour' => $data['cost_per_hour'],
               'allocated_spaces_count'=>$data['allocated_spaces_count'],
               'created_by' =>1,
                'created_at' => $time,
               'updated_at' => $time,
               'created_at_string' => Date('d-m-Y',$time),
               'allocated_day'=>1,
               'cost_per_day' => $data['cost_per_day'],
               'day_rate'=>$data['day_rate'] ? 1:0,
               'hour_rate'=>$data['hour_rate'] ? 1:0,
            ])->execute();
            
            $id = $db->getLastInsertID();
            
            
            $transaction->commit();

            return $id;

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