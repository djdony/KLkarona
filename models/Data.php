<?php

namespace app\models;

use app\modules\admin\models\LicenseType;
use Yii;

/**
 * This is the model class for table "data".
 *
 * @property int $id
 * @property string $name
 * @property string $idcard
 * @property string|null $licenseNo
 * @property int|null $license_id
 * @property int $created_by
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property string|null $created_at
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
            [['idcard'], 'required'],
            ['idcard','match', 'pattern' => '/^\d{6}-\d{2}-\d{4}$/', 'message' => 'Idcard should be in format 123456-12-1234'],
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
        return $this->hasOne(LicenseType::class, ['id' => 'license_id']);
    }

    /**
     * Gets data of model with idcard.
     *
     * @return \yii\db\ActiveQuery
     */
    public static function getDataByIdcard($idcard)
    {
        return self::find()->where(['idcard'=>$idcard])->one();
    }
}
