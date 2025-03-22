<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $role
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string|null $user_status
 * @property int|null $verification
 * @property int|null $active
 * @property int|null $deleted
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $authKey
 * @property string|null $accessToken
 *
 * @property Profiles[] $profiles
 * @property UserVerifications[] $userVerifications
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'username', 'email', 'password_hash'], 'required'],
            [['user_status'], 'string'],
            [['verification', 'active', 'deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['role'], 'string', 'max' => 20],
            [['username'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 150],
            [['password_hash'], 'string', 'max' => 60],
            [['authKey', 'accessToken'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'user_status' => 'User Status',
            'verification' => 'Verification',
            'active' => 'Active',
            'deleted' => 'Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profiles::class, ['user_id' => 'id']);
    }

    public function getReviews()
    {
        return $this->hasMany(Reviews::class, ['review_to' => 'id']);
    }
    public function getSubjects()
    {
        return $this->hasMany(TeacherSubjects::class, ['teacher_id' => 'id']);
    }
    public function getEducations()
    {
        return $this->hasMany(TeacherEducation::class, ['teacher_id' => 'id']);
    }
    public function getExperiences()
    {
        return $this->hasMany(TeacherProfessionalExperience::class, ['teacher_id' => 'id']);
    }
    public function getDetails()
    {
        return $this->hasOne(TeacherTeachingDetails::class, ['teacher_id' => 'id']);
    }
    public function getDescription()
    {
        return $this->hasOne(TeacherJobDescriptions::class, ['teacher_id' => 'id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profiles::class, ['user_id' => 'id']);
    }

    public function getWallet()
    {
        return $this->hasOne(Wallets::class, ['user_id' => 'id']);
    }

    public function getRole()
    {
        return $this->hasOne(Roles::class, ['id' => 'role_id']);
    }

    public function getUserVerifications()
    {
        return $this->hasMany(UserVerifications::class, ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }


    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }


    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        return $this->authKey;
    }


    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public static function createAdmin()
    {
        $admin = new self();
        $admin->username = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password_hash = Yii::$app->security->generatePasswordHash('12345678');
        $admin->role = 'superadmin';
        $admin->verification = 1;
        $admin->active = 1;
        $admin->deleted = 0;
        $admin->authKey = Yii::$app->security->generateRandomString();
        $admin->accessToken = Yii::$app->security->generateRandomString();

        return $admin->save();
    }
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }
    public function generateAccessToken()
    {
        $this->accessToken = Yii::$app->security->generateRandomString();
    }
    public function setRole($rolename)
    {
        $this->role = $rolename; // Assuming 2 is user role
    }
}
