<?php

namespace common\models;

use Yii;
use common\models\activeQuery\EmployeeActiveQuery;
use yii2mod\behaviors\CarbonBehavior;

/**
 * This is the model class for table "{{%employee}}".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int|null $deleted_at
 */
class Employee extends \yii\db\ActiveRecord
{
    
    public $extraFields = [
        'name',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%employee}}';
    }

 

    public function getCompany()
    {
        return $this->hasOne(Tenant::class,['id'=>'tenant_id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::class,['user_id'=>'id']);
    }

    public function getFullName()
    {
        try {
            //code...
            $last_name = $this->profile->last_name ? : ''; 
            $name = $this->profile->name ? : ''; 
            $patronymic = $this->profile->patronymic ? : ''; 
            return $last_name.' '.$name.' '.$patronymic;
        } catch (\Throwable $th) {
            //throw $th;
        }
   
        
    }

    public function getCreatedDate()
    {
         return date('d-m-Y', $this->created_at);
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tenant_id',], 'required'],
            [['created_at', 'updated_at', 'created_by', 'deleted_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'deleted_at' => 'Deleted At',
            'fullName' => 'Full Name',
         ];
    }

    /**
     * {@inheritdoc}
     * @return EmployeeActiveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeActiveQuery(get_called_class());
    }
}
?>