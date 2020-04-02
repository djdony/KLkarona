<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m200331_141054_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%backend_users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(250)->null(),
            'lastname' => $this->string(250)->null(),
            'email' => $this->string(250)->null(),
            'username' => $this->string(50)->notNull(),
            'password' => $this->string(),
        ]);


    }



    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%backend_users}}');
    }
}
