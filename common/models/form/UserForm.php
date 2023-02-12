<?php

namespace common\models\form;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class UserForm extends Model
{
    public $name;
    public $lastname;
    public $patronymic;
    public $phone_number;
    public $login;
    public $email;
    public $password;
    public $repeat_password;
    public $organization;
    public $role;
    


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'lastname','patronymic','organization','login','email','password','repeat_password','role'], 'required'],
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
            'car_description' => 'Описание автомобиля',
        ];
    }

}
