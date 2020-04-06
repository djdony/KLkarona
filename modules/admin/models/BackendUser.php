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
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['firstname', 'lastname', 'email'], 'string', 'max' => 250],
            [['username'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255],
            [['authKey'], 'string', 'max' => 100],
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
        return $this->hasMany(UserRegion::class, ['user_id' => 'id']);
    }


    /**
     * Gets query for [[Regions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::class, ['id' => 'region_id'])->viaTable('user_region', ['user_id' => 'id']);
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
        return $this->authKey;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }

    public  function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password,$this->password);
    }

    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }
}
