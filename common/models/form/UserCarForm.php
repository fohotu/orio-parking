<?php

namespace common\models\form;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class UserCarForm extends Model
{
    public $car_model;
    public $car_number;
    public $car_color;
    public $car_vin;
    public $start_date;
    public $end_date;
    public $user_id;
    


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_model', 'car_number','start_date','end_date'], 'required'],
            [['car_color','car_vin'],'string','max'=>16],
            
        ];
    }



    public function attributeLabels()
    {
        return [
            'car_model' => 'Модель автомобиля',
            'car_number' => 'Номер автомобиля',
            'start_date' => 'Пропуск с',
            'end_date' => 'Пропуск по',
            'car_color' => 'Цвет автомобиля',
            'car_vin' => 'VIN',
        ];
    }

}
