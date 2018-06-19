<?php

use yii\db\Migration;

/**
 * Class m180619_014520_create_access
 */
class m180619_014520_create_access extends Migration
{
    const TABLE_NAME = 'access';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);
    }
/*
 * CREATE TABLE `access` (
`id` INT NOT NULL AUTO_INCREMENT,
`event_id` INT NOT NULL,
`user_id` INT NOT NULL,
PRIMARY KEY (`id`)
)
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
        echo "m180619_014520_create_access cannot be reverted.\n";

        return false;
    }
    */
}
