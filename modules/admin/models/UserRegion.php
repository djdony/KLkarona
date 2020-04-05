<?php

namespace app\modules\admin\models;

use app\models\Region;
use Yii;

/**
 * This is the model class for table "user_region".
 *
 * @property int $user_id
 * @property int $region_id
 *
 * @property BackendUser $user
 * @property Region $region
 */
class UserRegion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'region_id'], 'required'],
            [['user_id', 'region_id'], 'default', 'value' => null],
            [['user_id', 'region_id'], 'integer'],
            [['user_id', 'region_id'], 'unique', 'targetAttribute' => ['user_id', 'region_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => BackendUser::class, 'targetAttribute' => ['user_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'region_id' => 'Region ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BackendUser::class, ['id' => 'user_id']);
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
