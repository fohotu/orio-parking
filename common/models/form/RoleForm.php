<?php

namespace common\models\form;

use Yii;
use yii\base\Model;

/**
 * Role form
 */
class RoleForm extends Model
{
    public $name;
    public $displayname;
 


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'displayname'], 'required'],
            [['name', 'displayname'],'string','max'=>64,'min'=>3],
        ];
    }



    public function attributeLabels()
    {
        return [
            'name' => 'Role name',
            'displayname' => 'Display name',
        ];
    }

}
