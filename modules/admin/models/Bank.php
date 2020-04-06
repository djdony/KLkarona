<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property int $id
 * @property string $title
 * @property bool $active
 * @property int $created_by
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property string|null $created_at
 *
 * @property Profiles[] $profiles
 */
class Bank extends \yii\db\ActiveRecord
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
            [['updated_at', 'created_at'], 'safe'],
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
        return $this->hasMany(Profile::class, ['bank_id' => 'id']);
    }
}
