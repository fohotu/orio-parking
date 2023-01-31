<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_parking}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $start_date
 * @property int $end_date
 * @property string $user_type
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 */
class UserParking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $startText;
    public $endText;

    public static function tableName()
    {
        return '{{%user_parking}}';
    }
    /*

    public function getStartText()
    {
        return date('d-m-Y', $this->start_date);
    }

    public function setStartText($value)
    {
        return date('d-m-Y', $this->start_date);
    }
    */

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'start_date', 'end_date', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['user_type'], 'string', 'max' => 8],
            [['startText','endText'], 'string', 'max' => 12],
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
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'user_type' => 'User Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\activeQuery\UserParkingActiveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\activeQuery\UserParkingActiveQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

      

        //$this->end_date = Yii::$app->formatter->asDate($this->end_date, 'U');

      //  var_dump($this->end_date);
        
        return true;
    }

}
