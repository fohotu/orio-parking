<?php

use yii\db\Migration;

/**
 * Class m230122_130845_car
 */
class m230122_130845_car extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('car', [
            'id' => $this->primaryKey(),
            'car_number' => $this->string()->notNull(),
           //'description' => $this->string(), 
            'car_model' => $this->string(), 
            'car_color' => $this->string(), 
            'car_vin' => $this->string(), 
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('car');
    }

    
}
