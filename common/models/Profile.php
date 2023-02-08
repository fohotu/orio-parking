<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $last_name
 * @property string $patronymic
 * @property string|null $phone_number
 * @property string $user_type
 * @property string|null $name
 */

use common\models\activeQuery\ProfileActiveQuery;

class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::class,['user_id'=>'id'])->where(['user_type'=>'employee']);
    }

    public function getFullName()
    {
        
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_name', 'patronymic'], 'required'],
           // [['user_id'], 'integer'],
            [['last_name', 'patronymic', 'phone_number', 'name'], 'string', 'max' => 255],
            [['user_type'], 'string', 'max' => 8],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'last_name' => 'Last Name',
            'patronymic' => 'Patronymic',
            'phone_number' => 'Phone Number',
            'user_type' => 'User Type',
            'name' => 'Name',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\activeQuery\ProfileQuery the active query used by this AR class.
     */

    public static function find()
    {
        return new ProfileActiveQuery(get_called_class());
    }

}
