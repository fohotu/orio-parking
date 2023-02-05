<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%car}}".
 *
 * @property int $id
 * @property string $car_number
 * @property string|null $description
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int|null $deleted_at
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_number'], 'required'],
            //[['created_at', 'updated_at', 'created_by', 'deleted_at'], 'integer'],
            [['car_number','description'], 'string', 'max' => 255],
        ];
    }

    public function getHistory()
    {
        return $this->hasMany(ParkingHistory::class,['car_id'=>'id']);
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::class, ['id' => 'user_id'])
            ->viaTable('user_car', ['car_id' => 'id'],function($query){
                $query->andWhere(['user_car.user_type'=>'employee']);
            });
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_number' => 'Car Number',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\activeQuery\CarActiveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\activeQuery\CarActiveQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $time = time();
        if($this->isNewRecord){
            $this->created_at = $time;
            $this->created_by = 1;   
        }

        $this->updated_at = $time;

        
        return true;
    }
}
