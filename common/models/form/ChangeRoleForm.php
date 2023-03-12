<?php

namespace common\models\form;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ChangeRoleForm extends Model
{
    public $role;
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'required'],    
        ];
    }



    public function attributeLabels()
    {
        return [
            'role' => 'Роль',
        ];
    }

}
