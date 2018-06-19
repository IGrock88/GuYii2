<?php

use yii\db\Migration;

/**
 * Class m180619_014511_create_event
 */
class m180619_014511_create_event extends Migration
{

    const TABLE_NAME = 'event';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'dt' => $this->dateTime()->notNull(),
            'creator_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()
        ]);
    }
    /*
     * CREATE TABLE `event` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `text` TEXT NOT NULL,
    `dt` DATETIME NOT NULL,
    `creator_id` INT NOT NULL,
    `created_at` INT NULL,
    PRIMARY KEY (`id`)
    );
     */
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180619_014511_create_event cannot be reverted.\n";

        return false;
    }
    */
}
