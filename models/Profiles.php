<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

class Profiles extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $avatarFile;  // Add this line to handle the file upload

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
            [['user_id', 'active', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['gender', 'address', 'avatar_url'], 'string'],
            [['full_name', 'nick_name', 'gender','country','phone_number'], 'required'], // Added required rule
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['languages'], 'required'],
            [['languages'], 'safe'],
            [['first_name', 'middle_name', 'last_name', 'full_name', 'nick_name', 'city', 'country', 'timezone'], 'string', 'max' => 100],
            [['phone_number'], 'string', 'max' => 20],
            [['avatarFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'], // Rule for file upload
        ];
    }

    /**
     * Uploads the image to the `uploads/` directory.
     *
     * @return bool|string the file path if upload was successful, false otherwise.
     */
    public function uploadAvatar()
    {
        $username = Yii::$app->user->identity->username;
        if ($this->validate() && $this->avatarFile) {
            $path = 'assets/uploads/avatars/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $filePath =  $path . $username . '_' . time() . '.' . $this->avatarFile->extension;
            $savedFile = $this->avatarFile->saveAs($filePath);
            if ($savedFile) {
                return $filePath;
            }
        }
        return false;
    }
}
