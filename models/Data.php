<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data".
 *
 * @property int $id
 * @property string $name
 * @property string $myKad
 * @property string|null $licenseNo
 * @property int|null $license_id
 *
 * @property LicenseType $license
 */
class Data extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'myKad'], 'required'],
            [['license_id'], 'default', 'value' => null],
            [['license_id'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['myKad'], 'string', 'max' => 17],
            [['licenseNo'], 'string', 'max' => 50],
            [['myKad'], 'unique'],
            [['license_id'], 'exist', 'skipOnError' => true, 'targetClass' => LicenseType::className(), 'targetAttribute' => ['license_id' => 'id']],
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
            'myKad' => 'My Kad',
            'licenseNo' => 'License No',
            'license_id' => 'License ID',
        ];
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
}
