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
    public $car_number;
    public $car_description;
    public $pass_from;
    public $pass_to;
    public $tenant_id;
 


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'lastname','patronymic','car_number','pass_from','pass_to','tenant_id'], 'required'],
            [['phone_number'],'string','max'=>16,'min'=>6],
            [['car_description'],'string','max'=>200],
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
            'car_description' => 'Описание автомобиля',
        ];
    }

}
