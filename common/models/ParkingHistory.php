<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%parking_history}}".
 *
 * @property int $id
 * @property int $car_id
 * @property string|null $action_type
 * @property int $action_date
 * @property int $enter_date
 * @property int $exit_date
 */
class ParkingHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%parking_history}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_id', 'action_date'], 'required'],
            [['car_id', 'action_date', 'enter_date', 'exit_date'], 'integer'],
            [['action_type'], 'string', 'max' => 9],
        ];
    }

    public function getCar()
    {
        return $this->hasOne(Car::class,['id'=>'car_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => 'Car ID',
            'action_type' => 'Action Type',
            'action_date' => 'Action Date',
            'enter_date' => 'Enter Date',
            'exit_date' => 'Exit Date',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\activeQuery\ParkingHistoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\activeQuery\ParkingHistoryActiveQuery(get_called_class());
    }
}
