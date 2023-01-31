<?php 
namespace common\service;

use Yii;
use common\models\Profile;
use common\models\Employee;
use common\models\Car;

class EmployeeService extends BaseService implements ServiceInterface{
        
    public function add()
    {
        echo 'Add Employee';
    }

    public function create($data)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            $time = time();
            $db->createCommand()->insert('employee',[
               'created_at' => $time,
               'updated_at' => $time,
               'created_by' => 1,
               'tenant_id' => $data['tenant_id']      
            ])->execute();
            
            $employeeId = $db->getLastInsertID();
            $db->createCommand()->insert('profile',[
                'user_id' => $employeeId,
                'last_name' => $data['lastname'],
                'patronymic' => $data['patronymic'],
                'phone_number' => $data['phone_number'],
                'user_type' => 'employee',
                'name' => $data['name'],
             ])->execute();

             $db->createCommand()->insert('car',[
                'car_number' => $data['car_number'],
                'description' => $data['car_description'],
                'created_at' => $time,
                'updated_at' => $time,
                'created_by' => 1,
             ])->execute();

             $carId = $db->getLastInsertID();
             $db->createCommand()->insert('user_car',[
                'user_id' => $employeeId,
                'car_id' => $carId,
                'user_type' => 'employee',
             ])->execute();


             $db->createCommand()->insert('user_parking',[
                'user_id' => $employeeId,
                'start_date' => $this->mkTimeFromStr($data['pass_from']),
                'end_date' => $this->mkTimeFromStr($data['pass_to']),
                'user_type' => 'employee',
                'created_at' => $time,
                'updated_at' => $time,
             ])->execute();
            
            
            $transaction->commit();

            return $employeeId;

        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

    }


    public function update($model,$data)
    {
        $model->profile->load($data);
        $model->car[0]->setAttributes($data);


        $model->userParking->setAttributes($data);
       // var_dump($data);
        $model->userParking->start_date =$this->mkTimeFromStr($data['UserParking']['start_date']);
        $model->userParking->end_date =$this->mkTimeFromStr($data['UserParking']['end_date']);
       // var_dump($model->userParking->attributes);exit;
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();

        try {
            if($model->save()){
                $model->profile->save();
                $model->userParking->save();
                $model->car[0]->save();
            }
            // ...другие операции с базой данных...
            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }


    



}

?>