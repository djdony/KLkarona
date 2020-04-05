<?php

use yii\db\Migration;

/**
 * Handles the creation of table `banks`.
 */
class m200331_172139_create_banks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bank', [
            'id' => $this->primaryKey(),
            'title' => $this->string(12)->notNull()->unique(),
            'active' => $this->boolean()->defaultValue(true)->notNull(),
            'created_by' => $this->integer()->defaultValue(1)->notNull(),
            'updated_by' => $this->integer()->null(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        //index for active
        $this->createIndex(
          'idx-bank-active',
          'bank',
          'active'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('bank');
    }
}
