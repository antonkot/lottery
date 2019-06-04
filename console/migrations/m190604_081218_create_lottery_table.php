<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lottery}}`.
 */
class m190604_081218_create_lottery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lottery}}', [
            'id' => $this->primaryKey(),
            'date_start' => $this->integer()->notNull(),
            'date_end' => $this->integer()->notNull(),
            'money_left' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lottery}}');
    }
}
