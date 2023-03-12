<?php

use yii\db\Migration;

/**
 * Class m230122_130904_user_car
 */
class m230122_130904_user_car extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_car', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'car_id' => $this->integer()->notNull(),// 
            'user_type' => $this->string(8)->notNull()->defaultValue('user'),//user or employee
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_car'); 
    }

}
