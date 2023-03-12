<?php

namespace common\models\form;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ChangePasswordForm extends Model
{
    public $password;
    public $repeat_password;
    


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password','repeat_password'], 'required'],    
            [['repeat_password'], 'compare','compareAttribute'=>'password'],    
        ];
    }



    public function attributeLabels()
    {
        return [
            'password' => 'Пароль',
            'repeat_password' => 'Повторите пароль',
        ];
    }

}
