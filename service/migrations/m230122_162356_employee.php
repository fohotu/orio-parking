<?php

use yii\db\Migration;

/**
 * Class m230122_162356_employee
 */
class m230122_162356_employee extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('employee', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),// 
            'deleted_at' => $this->integer(),
            'tenant_id' => $this->integer()->notNull(),
        ]);        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('employee');
    }

   
}
