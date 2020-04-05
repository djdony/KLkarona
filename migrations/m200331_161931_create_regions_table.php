<?php

use yii\db\Migration;

/**
 * Handles the creation of table `regions`.
 */
class m200331_161931_create_regions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('region', [
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
          'idx-region-active',
          'region',
          'active'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('region');
    }
}
