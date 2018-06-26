<?php

use yii\db\Migration;

/**
 * Class m180619_014458_create_user
 */
class m180619_014458_create_user extends Migration
{
    const TABLE_NAME = 'user';
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
