<?php

use yii\db\Migration;

/**
 * Class m180619_014458_create_user
 */
class m180619_014458_create_user extends Migration
{
    const TABLE_NAME = 'users';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string(),
            'password_hash' => $this->string()->notNull(),
            'access_token' => $this->string()->defaultValue('NULL'),
            'auth_key' => $this->string()->defaultValue('NULL'),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }
/*
 * CREATE TABLE `user` (
`id` INT NOT NULL AUTO_INCREMENT,
`username` VARCHAR(255) NOT NULL,
`name` VARCHAR(255) NOT NULL,
`surname` VARCHAR(255) NULL,
`password_hash` VARCHAR(255) NOT NULL,
`access_token` VARCHAR(255) NULL DEFAULT NULL,
`auth_key` VARCHAR(255) NULL DEFAULT NULL,
`created_at` INT NULL,
`updated_at` INT NULL,
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
        echo "m180619_014458_create_user cannot be reverted.\n";

        return false;
    }
    */
}
