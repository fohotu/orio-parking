<?php

use yii\db\Migration;

/**
 * Class m230122_130018_user_parking
 */
class m230122_130018_user_parking extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_parking', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'start_date' => $this->integer()->notNull(),// 
            'end_date' => $this->integer()->notNull(), //
            'user_type' => $this->string(8)->notNull()->defaultValue('user'), //user or employee
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_parking');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230122_130018_user_parking cannot be reverted.\n";

        return false;
    }
    */
}
