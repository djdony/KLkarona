<?php

use yii\db\Migration;

/**
 * Handles the creation of table `profile`.
 */
class m200331_172310_create_profiles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('profile', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
            'idcard' => $this->string(17)->notNull()->unique(),
            'address' => $this->string(150)->null(),
            'postcode' => $this->integer()->null(),
            'region_id' => $this->integer()->null(),
            'phone' => $this->string(50)->null(),
            // backend_users.email = 250 chars?
            'email' => $this->string(250)->null(),
            'license_no' => $this->string(50)->null(),
            'license_id' => $this->integer()->null(),
            'bank_id' => $this->integer()->null(),
            'bank_account' => $this->integer()->null(),
            'bank_holder' => $this->string(100)->null(),
            'sign_date' => $this->date()->null(),
            'sign_name' => $this->string(150)->null(),
            'sign_idcard' => $this->string(17)->null(),
            'status_id' => $this->integer()->defaultValue(0),
            'created_by' => $this->integer()->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_by' => $this->integer(),
            'updated_at' => $this->timestamp(),
        ]);

        // creates index for column `license_id`
        $this->createIndex(
            'idx-profile-license_id',
            'profile',
            'license_id'
        );


        $this->addForeignKey(
            'fk-license_id',
            'profile',
            'license_id',
            'license_type',
            'id'
        );


        // creates index for column `bank_id`
        $this->createIndex(
            'idx-profile-bank_id',
            'profile',
            'bank_id'
        );


        // add foreign key for table `bank`
        $this->addForeignKey(
            'fk-bank_id',
            'profile',
            'bank_id',
            'bank',
            'id'
        );

        // creates index for column `region_id`
        $this->createIndex(
            'idx-region_id',
            'profile',
            'region_id'
        );

        // add foreign key for table `region`
        $this->addForeignKey(
            'fk-region_id',
            'profile',
            'region_id',
            'region',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('profile');
    }
        // let's look at views.
}
