<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profiles}}`.
 */
class m200331_172310_create_profiles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%profiles}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
            'idcard' => $this->string(17)->notNull()->unique(),
            'address' => $this->string(150)->null(),
            'phone' => $this->string(50)->null(),
            'email' => $this->string(100)->null(),
            'licenseNo' => $this->string(50)->null(),
            'bank_holder' => $this->string(100)->null(),
            'license_id' => $this->integer()->null(),
            'postcode' => $this->integer()->null(),
            'bank_id' => $this->integer()->null(),
            'bank_account' => $this->integer()->null(),
            'region_id' => $this->integer()->null(),
            'sign_date' => $this->date()->null(),
            'sign_name' => $this->string(150)->null(),
            'sign_idcard' => $this->string(17)->null(),
            'status' => $this->integer()->defaultValue(0),
            'active' => $this->boolean()->null(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `license_id`
        $this->createIndex(
            '{{%idx-profile-license_id}}',
            '{{%profiles}}',
            'license_id'
        );

        // add foreign key for table `{{%license}}`
        $this->addForeignKey(
            '{{%fk-license_id}}',
            '{{%profiles}}',
            'license_id',
            '{{%license_types}}',
            'id',
            'CASCADE'
        );

        // creates index for column `bank_id`
        $this->createIndex(
            '{{%idx-bank_id}}',
            '{{%profiles}}',
            'bank_id'
        );

        // add foreign key for table `{{%bank}}`
        $this->addForeignKey(
            '{{%fk-bank_id}}',
            '{{%profiles}}',
            'bank_id',
            '{{%banks}}',
            'id',
            'CASCADE'
        );

        // creates index for column `region_id`
        $this->createIndex(
            '{{%idx-region_id}}',
            '{{%profiles}}',
            'region_id'
        );

        // add foreign key for table `{{%region}}`
        $this->addForeignKey(
            '{{%fk-region_id}}',
            '{{%profiles}}',
            'region_id',
            '{{%regions}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profiles}}');
    }
}
