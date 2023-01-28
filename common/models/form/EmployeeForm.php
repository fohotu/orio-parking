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
 


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'lastname','patronymic','car_number','pass_form','pass_to'], 'required'],
            [['phone_number'],'string','max'=>16,'min'=>6],
            [['car_description'],'string','max'=>200],
        ];
    }

}
