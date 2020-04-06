<?php

use yii\db\Migration;

/**
 * Handles the creation of table `data`.
 */
class m200331_172249_create_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('data', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
            'idcard' => $this->string(17)->notNull()->unique(),
            'license_no' => $this->string(50)->null(),
            'license_id' => $this->integer()->null(),
            'created_by' => $this->integer()->defaultValue(1)->notNull(),
            'updated_by' => $this->integer()->null(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `license_id`
        $this->createIndex(
            'idx-license_id',
            'data',
            'license_id'
        );

        // add foreign key for table `license`
        $this->addForeignKey(
            'fk-license_id',
            'data',
            'license_id',
            'license_type',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('data');
    }
}
