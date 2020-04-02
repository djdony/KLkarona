<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profiles".
 *
 * @property int $id
 * @property string $name
 * @property string $idcard
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $licenseNo
 * @property string|null $bank_holder
 * @property int|null $license_id
 * @property int|null $postcode
 * @property int|null $bank_id
 * @property int|null $bank_account
 * @property int|null $region_id
 * @property string|null $sign_date
 * @property string|null $sign_name
 * @property string|null $sign_idcard
 * @property int|null $status
 * @property bool|null $active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property string|null $created_at
 *
 * @property Banks $bank
 * @property LicenseTypes $license
 * @property Regions $region
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'idcard'], 'required'],
            [['license_id', 'postcode', 'bank_id', 'bank_account', 'region_id', 'status', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['license_id', 'postcode', 'bank_id', 'bank_account', 'region_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['sign_date', 'updated_at', 'created_at'], 'safe'],
            [['active'], 'boolean'],
            [['name', 'address', 'sign_name'], 'string', 'max' => 150],
            [['idcard', 'sign_idcard'], 'string', 'max' => 17],
            [['phone', 'licenseNo'], 'string', 'max' => 50],
            [['email', 'bank_holder'], 'string', 'max' => 100],
            [['idcard'], 'unique'],
            [['bank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::className(), 'targetAttribute' => ['bank_id' => 'id']],
            [['license_id'], 'exist', 'skipOnError' => true, 'targetClass' => LicenseType::className(), 'targetAttribute' => ['license_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
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
            'phone' => 'Phone',
            'email' => 'Email',
            'licenseNo' => 'License No',
            'bank_holder' => 'Bank Holder',
            'license_id' => 'License ID',
            'postcode' => 'Postcode',
            'bank_id' => 'Bank ID',
            'bank_account' => 'Bank Account',
            'region_id' => 'Region ID',
            'sign_date' => 'Sign Date',
            'sign_name' => 'Sign Name',
            'sign_idcard' => 'Sign Idcard',
            'status' => 'Status',
            'active' => 'Active',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Bank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::className(), ['id' => 'bank_id']);
    }

    /**
     * Gets query for [[License]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLicense()
    {
        return $this->hasOne(LicenseType::className(), ['id' => 'license_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }
}
