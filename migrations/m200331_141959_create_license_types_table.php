<?php

use yii\db\Migration;

/**
 * Handles the creation of table `licence_types`.
 */
class m200331_141959_create_license_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('license_type', [
            'id' => $this->primaryKey(),
            'title' => $this->string(12)->notNull()->unique(),
            'active' => $this->boolean()->defaultValue(true)->notNull(),
            'created_by' => $this->integer()->defaultValue(1)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_by' => $this->integer(),
            'updated_at' => $this->timestamp(),
        ]);

        //index for active
        $this->createIndex(
          'idx-license_type-active',
          'license_type',
          'active'
        );
    }


    //ok?

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('license_type');
    }
}
