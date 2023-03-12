<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car}}`.
 */
class m230305_091015_create_car_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car}}', [
            'id' => $this->primaryKey(),
            'car_number' => $this->string()->notNull(),
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
        $this->dropTable('{{%car}}');
    }
}
