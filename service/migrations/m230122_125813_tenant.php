<?php

use yii\db\Migration;

/**
 * Class m230122_125813_organization
 */
class m230122_125813_tenant extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tenant', [
            'id' => $this->primaryKey(),
            'tenant_name' => $this->string()->notNull(),//Наименование организации 
            'tin' => $this->string(), //Tax identification number (ИНН)
            'bic' => $this->string(), //БИК
            'checking_account' => $this->string(),//р/с
            'address' => $this->text(),
            'bank_name' => $this->text(),
            'cost_per_hour' => $this->text(),
            'allocated_spaces_count' => $this->integer(), //Количество выделяемых машиномест 
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
            'created_at_string' => $this->string(8),

        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tenant');
    }

   
}
