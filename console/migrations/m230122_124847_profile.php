<?php

use yii\db\Migration;

/**
 * Class m230122_124847_profile
 */
class m230122_124847_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('profile', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(), //
            'last_name' => $this->string()->notNull(), //
            'patronymic' => $this->string()->notNull(), //отчество
            'phone_number' => $this->string(),
            'user_type' => $this->string(8)->notNull()->defaultValue('user'),//user or employee

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('profile'); 
    }

    
}
