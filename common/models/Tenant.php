<?php

namespace common\models;

use common\models\activeQuery\TenantActiveQuery;
use common\models\receive\TenantReceive;
use Yii;

/**
 * This is the model class for table "{{%tenant}}".
 *
 * @property int $id
 * @property string $tenant_name
 * @property string|null $tin
 * @property string|null $bic
 * @property string|null $checking_account
 * @property string|null $address
 * @property string|null $bank_name
 * @property string|null $cost_per_hour
 * @property int|null $allocated_spaces_count
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int|null $deleted_at
 */
class Tenant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tenant}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tenant_name'], 'required'],
            [['address', 'bank_name', 'cost_per_hour'], 'string'],
            [['allocated_spaces_count'], 'integer'],
            [['tenant_name', 'tin', 'bic', 'checking_account'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tenant_name' => 'Наименование',
            'tin' => 'ИНН',
            'bic' => 'БИК',
            'checking_account' => 'Расчётный счёт',
            'address' => 'Адрес',
            'bank_name' => 'Наименование банка',
            'cost_per_hour' => 'Стоимость за час аренды',
            'allocated_spaces_count' => 'Количество выделяемых машиномест',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TenantActiveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TenantActiveQuery(get_called_class());
    }

    public static function receive()
    {
        return new TenantReceive(get_called_class());
    }

    public function beforeSave($insert)
    {
        $t = time(); 
        $this->created_by = 1;
        $this->created_at = $t;
        $this->updated_at = $t;
        return parent::beforeSave($insert);
    }

   
}
