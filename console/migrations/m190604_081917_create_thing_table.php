<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%thing}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%lottery}}`
 */
class m190604_081917_create_thing_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%thing}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'amount' => $this->integer()->notNull(),
            'lottery_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `lottery_id`
        $this->createIndex(
            '{{%idx-thing-lottery_id}}',
            '{{%thing}}',
            'lottery_id'
        );

        // add foreign key for table `{{%lottery}}`
        $this->addForeignKey(
            '{{%fk-thing-lottery_id}}',
            '{{%thing}}',
            'lottery_id',
            '{{%lottery}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%lottery}}`
        $this->dropForeignKey(
            '{{%fk-thing-lottery_id}}',
            '{{%thing}}'
        );

        // drops index for column `lottery_id`
        $this->dropIndex(
            '{{%idx-thing-lottery_id}}',
            '{{%thing}}'
        );

        $this->dropTable('{{%thing}}');
    }
}
