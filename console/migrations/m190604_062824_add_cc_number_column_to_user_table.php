<?php

use yii\db\Migration;

/**
 * Handles adding cc_number to table `{{%user}}`.
 */
class m190604_062824_add_cc_number_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'cc_number', $this->integer());
        $this->addColumn('{{%user}}', 'loyalty_points', $this->integer());
        $this->addColumn('{{%user}}', 'address', $this->string());
        $this->addColumn('{{%user}}', 'full_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'full_name');
        $this->dropColumn('{{%user}}', 'address');
        $this->dropColumn('{{%user}}', 'loyalty_points');
        $this->dropColumn('{{%user}}', 'cc_number');
    }
}
