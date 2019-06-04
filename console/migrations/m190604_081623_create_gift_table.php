<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gift}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%lottery}}`
 */
class m190604_081623_create_gift_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%gift}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
            'amount' => $this->integer(),
            'sent' => $this->integer()->defaultValue(0),
            'thing_id' => $this->integer(),
            'lottery_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-gift-user_id}}',
            '{{%gift}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-gift-user_id}}',
            '{{%gift}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `lottery_id`
        $this->createIndex(
            '{{%idx-gift-lottery_id}}',
            '{{%gift}}',
            'lottery_id'
        );

        // add foreign key for table `{{%lottery}}`
        $this->addForeignKey(
            '{{%fk-gift-lottery_id}}',
            '{{%gift}}',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-gift-user_id}}',
            '{{%gift}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-gift-user_id}}',
            '{{%gift}}'
        );

        // drops foreign key for table `{{%lottery}}`
        $this->dropForeignKey(
            '{{%fk-gift-lottery_id}}',
            '{{%gift}}'
        );

        // drops index for column `lottery_id`
        $this->dropIndex(
            '{{%idx-gift-lottery_id}}',
            '{{%gift}}'
        );

        $this->dropTable('{{%gift}}');
    }
}
