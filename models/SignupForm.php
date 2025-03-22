<?php

namespace app\models;

use app\components\Helper;
use Yii;
use yii\base\Model;
use app\models\User;

/**
 * SignupForm is the model behind the signup form.
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $role = 'student';
    public $user_status = 'unverified';

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['role', 'string'],
            ['role', 'required'],
            ['role', 'in', 'range' => ['student', 'tutor', 'admin', 'superadmin']],

            ['password', 'trim'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function usersignup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->setRole($this->role);
        $user->user_status = $this->user_status;
        $saved = $user->save();
        Yii::$app->session->set("loggedUserId", $user->id);
        if (!$saved) {
            Yii::error($user->getErrors());
            return null;
        }
        $token = Yii::$app->security->generateRandomString();
        $emailVerificationLink = Helper::baseUrl("/verify?token={$token}");

        $userVerification = new UserVerifications();
        $userVerification->user_id = $user->id;
        $userVerification->email = $user->email;
        $userVerification->email_verification_link = $emailVerificationLink;
        $userVerification->email_verification_expires = date('Y-m-d H:i:s', strtotime('+24 hours'));
        $verifcationSaved = $userVerification->save();
        if (!$verifcationSaved) {
            echo '<pre>';
            print_r($userVerification->getErrors());
            echo '</pre>';
            die;
        }
        Helper::SendVerificationMail($user->email, $user->username, $emailVerificationLink);
        $userToLogin = User::findOne($user->id);
        if ($userToLogin instanceof \yii\web\IdentityInterface) {
            Yii::$app->user->login($userToLogin);
        }
        return $saved;
    }
}
