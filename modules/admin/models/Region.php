<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string $title
 * @property bool $active
 * @property int $created_by
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property string|null $created_at
 *
 * @property Profile[] $profile
 * @property UserRegion[] $userregion
 * @property BackendUser[] $user
 */
class Region extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['active'], 'boolean'],
            [['created_by', 'updated_by'], 'default', 'value' => null],
            [['created_by', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 12],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'active' => 'Active',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['region_id' => 'id']);
    }

    /**
     * Gets query for [[Userregion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserregion()
    {
        return $this->hasMany(UserRegion::class, ['region_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(BackendUser::class, ['id' => 'user_id'])->viaTable('user_region', ['region_id' => 'id']);
    }
}
