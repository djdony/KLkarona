<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "backend_users".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $lastname
 * @property string|null $email
 * @property string $username
 * @property string|null $password
 * @property string|null $authKey
 *
 * @property UserRegion[] $userRegions
 * @property Regions[] $regions
 */
class BackendUser extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'backend_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['name', 'lastname', 'email'], 'string', 'max' => 250],
            [['username'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255],
            [['authKey'], 'string', 'max' => 1],
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
            'lastname' => 'Lastname',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
        ];
    }

    /**
     * Gets query for [[UserRegions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserRegions()
    {
        return $this->hasMany(UserRegion::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Regions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Regions::className(), ['id' => 'region_id'])->viaTable('user_region', ['user_id' => 'id']);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        throw new NotSupportedException();
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException();
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }

    public  function validatePassword($password)
    {
        return $this->password === $password;
    }
}