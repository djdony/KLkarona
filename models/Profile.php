<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $name
 * @property string $idcard
 * @property string|null $address
 * @property int|null $postcode
 * @property int|null $region_id
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $license_no
 * @property int|null $license_id
 * @property int|null $bank_id
 * @property int|null $bank_account
 * @property string|null $bank_holder
 * @property string|null $sign_date
 * @property string|null $sign_name
 * @property string|null $sign_idcard
 * @property int|null $status_id
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property Bank $bank
 * @property LicenseType $license
 * @property Region $region
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'idcard'], 'required'],
            [['postcode', 'region_id', 'license_id', 'bank_id', 'bank_account', 'status_id', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['postcode', 'region_id', 'license_id', 'bank_id', 'bank_account', 'status_id', 'created_by', 'updated_by'], 'integer'],
            [['sign_date', 'created_at', 'updated_at'], 'safe'],
            [['name', 'address', 'sign_name'], 'string', 'max' => 150],
            [['idcard', 'sign_idcard'], 'string', 'max' => 17],
            [['phone', 'license_no'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 250],
            [['bank_holder'], 'string', 'max' => 100],
            [['idcard'], 'unique'],
            [['bank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::class, 'targetAttribute' => ['bank_id' => 'id']],
            [['license_id'], 'exist', 'skipOnError' => true, 'targetClass' => LicenseType::class, 'targetAttribute' => ['license_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'idcard' => 'Idcard',
            'address' => 'Address',
            'postcode' => 'Postcode',
            'region_id' => 'Region ID',
            'phone' => 'Phone',
            'email' => 'Email',
            'license_no' => 'License No',
            'license_id' => 'License ID',
            'bank_id' => 'Bank ID',
            'bank_account' => 'Bank Account',
            'bank_holder' => 'Bank Holder',
            'sign_date' => 'Sign Date',
            'sign_name' => 'Sign Name',
            'sign_idcard' => 'Sign Idcard',
            'status_id' => 'Status ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Bank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::class, ['id' => 'bank_id']);
    }

    /**
     * Gets query for [[License]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLicense()
    {
        return $this->hasOne(LicenseType::class, ['id' => 'license_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'region_id']);
    }
}
