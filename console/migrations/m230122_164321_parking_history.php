<?php

use yii\db\Migration;

/**
 * Class m230122_164321_parking_history
 */
class m230122_164321_parking_history extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('parking_history', [
            'id' => $this->primaryKey(),
            'car_id' => $this->integer()->notNull(),
            'action_type' => $this->string('9'), //entry or departure
            'action_date' => $this->integer()->notNull(), //отчество
            'event_id'=>$this->string(),
            'event_data'=>$this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('parking_history');
    }

   
}
