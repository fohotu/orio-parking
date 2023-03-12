<?php

namespace common\models\form;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class EmployeeForm extends Model
{
    public $name;
    public $lastname;
    public $patronymic;
    public $phone_number;
    public $tenant_id;
 


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'lastname','patronymic','tenant_id'], 'required'],
            [['phone_number'],'string','max'=>16,'min'=>6],
        ];
    }



    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'lastname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'car_number' => 'Номер автомобиля',
            'pass_from' => 'Пропуск с',
            'pass_to' => 'Пропуск по',
            'phone_number' => 'Контактный телефон',
            'car_model' => 'Модель автомобиля',
            'car_vin' => 'VIN',
            'car_color' => 'Цвет автомобиля',
        ];
    }

}
