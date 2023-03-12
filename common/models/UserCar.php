<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_car}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $car_id
 * @property string $user_type
 */
class UserCar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_car}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'car_id'], 'required'],
            [['user_id', 'car_id'], 'integer'],
            [['user_type'], 'string', 'max' => 8],
        ];
    }

    public function getCar()
    {
        return $this->hasOne(Car::class, ['id' => 'car_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    public function getStartDateText()
    {
        return Date('d-m-Y',$this->start_date);
    }

    public function getEndDateText()
    {
        return Date('d-m-Y',$this->end_date);
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'car_id' => 'Car ID',
            'user_type' => 'User Type',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\activeQuery\UserCarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\activeQuery\UserCarActiveQuery(get_called_class());
    }
}
