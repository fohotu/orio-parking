<?php

namespace common\models\form;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class TenantForm extends Model
{

    public $tenant_name;
    public $tin;
    public $bic;
    public $checking_account;
    public $address;
    public $bank_name;
    public $cost_per_hour;
    public $allocated_spaces_count;
    public $allocated_day;
    public $cost_per_day;
  //  public $unlime_rate;
    public $day_rate;
    public $hour_rate;
    public $unlim_users;
    


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tenant_name','allocated_spaces_count'], 'required'] 
        ];
        
    }



    public function attributeLabels()
    {
        return [

            'tenant_name' => 'Наименование',
            'tin' => 'ИНН',
            'bic' => 'БИК',
            'checking_account' => 'Расчётный счёт',
            'address' => 'Адрес',
            'bank_name' => 'Наименование банка',
            'cost_per_hour' => 'Стоимость за час',
            'allocated_spaces_count' => 'Количество выделяемых машиномест',
            'allocated_day' => 'allocated_day',
            'cost_per_day' => 'Стоимость за день',
            'unlime_rate' => 'Безлимитный Тариф',
            'day_rate' => 'Тариф по дням ',
            'hour_rate' => 'Почасовой Тариф',
            'unlime_users' => 'Unlime users',
        
        ];
    }


    public function validateRate($attribute, $params)
    {

        
        //if(!$this->day_rate && $this->hour_rate){
           // $this->addError($attribute, 'Страна должна быть либо "USA" или "Indonesia".');
       // }
/*
        if($this->hour_rate){

        }

        if (!in_array($this->$attribute, ['USA', 'Indonesia'])) {
            $this->addError($attribute, 'Страна должна быть либо "USA" или "Indonesia".');
        }

        */
    }

}
