<?php 
namespace common\service;

use Yii;
use common\models\Profile;
use common\models\Employee;
use common\models\Car;

class UserService extends BaseService implements ServiceInterface{


    public function create($data)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            $time = time();
            $db->createCommand()->insert('user',[
               'username'=>$data['login'],
               'password_hash'=>Yii::$app->getSecurity()->generatePasswordHash($data['password']),
               'auth_key'=>Yii::$app->security->generateRandomString(),
               'email' => $data['email'],
               'status'=>10,
                'created_at' => $time,
               'updated_at' => $time,
               'tenant_id' => $data['organization']      
            ])->execute();
            
            $userId = $db->getLastInsertID();
            $db->createCommand()->insert('profile',[
                'user_id' => $userId,
                'last_name' => $data['lastname'],
                'patronymic' => $data['patronymic'],
                'phone_number' => $data['phone_number'],
                'user_type' => 'user',
                'name' => $data['name'],
             ])->execute();

            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole($data['role']);
            $auth->assign($authorRole, $userId);
            
            
            $transaction->commit();

            return $userId;

        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

    }

}