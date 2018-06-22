<?php

use yii\db\Migration;

/**
 * Class m180622_012817_create_foreign_keys
 */
class m180622_012817_create_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {
        $this->addForeignKey('fx_access_user', 'access', ['user_id'], 'users', ['id']);
        $this->addForeignKey('fx_access_event', 'access', ['event_id'], 'event', ['id']);
        $this->addForeignKey('fx_event_user', 'event', ['creator_id'], 'users', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fx_access_user', 'access');
        $this->dropForeignKey('fx_access_event', 'access');
        $this->dropForeignKey('fx_event_user', 'event');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180622_012817_create_foreign_keys cannot be reverted.\n";

        return false;
    }
    */
}
