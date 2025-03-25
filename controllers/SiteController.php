<?php

namespace app\controllers;

use app\components\Wallet;
use app\models\Referrals;
use app\models\UserLeaveLog;
use app\models\UserVerifications;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Roles;
use app\models\SignupForm;
use app\models\User;
use app\models\UserReferralCodes;

class SiteController extends Controller
{
    public function beforeAction($action)
    {
        $actionId = $action->id;
        $controllerId = $this->id;

        // PUBLIC ACTIONS
        $publicActions = ['index', 'tutors', 'tutor-profile', 'contact', 'verify', 'about', 'login', 'signup', 'error'];

        // Check if user is guest and trying to access restricted area
        if (Yii::$app->user->isGuest && !in_array($actionId, $publicActions)) {
            Yii::$app->session->setFlash('error', 'Please login to access this page.');
            Yii::$app->response->redirect(['/login'])->send();
            return false;
        }


        // Role-based access control
        if (!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity;
            $userRole = $user->role;

            // check user verificaiton
            if (!$user->verification && ($actionId != "verification" && $actionId != "verify")) {
                return $this->redirect(['/verification']);
            }

            // Define role-specific permissions
            $permissions = [
                'superadmin' => ['*'],
                'admin' => ['*'],
                'tutor' => ['index', 'tutors', 'tutor-profile', 'verification', 'verify', 'verify-phone', 'contact', 'about', 'error', 'logout'],
                'student' => ['index', 'tutors', 'tutor-profile', 'verification', 'verify', 'verify-phone', 'contact', 'about', 'error', 'logout'],
            ];

            // Check if user has permission
            if (!in_array($actionId, $permissions[$userRole]) && $permissions[$userRole] !== ['*']) {
                Yii::$app->session->setFlash('error', 'You do not have permission to access this page.');
                return $this->redirect(['site/index']);
            }
        }

        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogUserLeaving()
    {
        if (!Yii::$app->user->isGuest) {
            $rawData = Yii::$app->request->getRawBody();
            $data = json_decode($rawData, true);
            if ($data) {
                $model = new UserLeaveLog();
                $model->message = $data['message'] ?? 'User left the page';
                $timestamp = $data['timestamp'] ?? null;
                if ($timestamp) {
                    $model->user_id = Yii::$app->user->identity->id;
                    // Convert JavaScript timestamp (milliseconds) to seconds for PHP
                    $model->left_at = date('Y-m-d H:i:s', $timestamp / 1000);
                } else {
                    // Fallback to current server time if timestamp is missing
                    $model->left_at = date('Y-m-d H:i:s');
                }
                $model->save();
                return $this->asJson(['status' => 'success']);
            }
        }
        return $this->asJson(['status' => 'error', 'message' => 'Invalid data']);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTutors()
    {
        $this->layout="tutors_page_layout";
        $tutors = User::find()->with(['reviews', 'profile', 'subjects'])->where(['role' => 'tutor'])->all();
        return $this->render('tutors', ['tutors' => $tutors]);
    }

    public function actionTutorProfile()
    {
        $this->layout="tutors_page_layout";

        $tutor = User::find()->with(['reviews', 'profile', 'subjects', 'educations', 'experiences', 'details', 'description'])->where(['role' => 'tutor'])->one();
        // var_dump($tutor);exit();

        return $this->render('tutor-profile', ['tutor' => $tutor]);
    }

    public function actionLogin()
    {
        $this->layout = "login_layout";

        $usersCount = User::find()->count();
        if ($usersCount == 0) {
            // Add roles
            Roles::addDefaultRoles();

            // Add first admin
            User::createAdmin();
        }

        $model = new LoginForm();
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            if ($model->load($postData)) {
                $loginResult = $model->login();
                if ($loginResult) {
                    $user = Yii::$app->user->identity;

                    if ($user->role === 'student') {
                        $profile = $user->profiles;
                        if ($profile === null) {
                            return $this->redirect(['profile/create']);
                        } else {
                            return $this->redirect(['post/list']);
                        }
                    } elseif ($user->role === 'tutor') {
                        return $this->redirect(['tutor/teacher-profile']);
                    }

                    return $this->goHome();
                }
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $this->layout="login_layout";
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $isSignup = $model->usersignup();
            if ($isSignup) {
                $referralCode = Yii::$app->request->get("referral-code");
                if (!empty($referralCode)) {
                    $referrer = UserReferralCodes::find()->with(['referrer'])->where(['referral_code' => $referralCode])->one();

                    $referral = new Referrals();
                    $referral->referrer_id = $referrer->user_id;
                    $referral->referred_user_id = Yii::$app->session->get("loggedUserId");
                    $referral->referral_code = $referralCode;
                    $referral->referral_status = "Pending";
                    $referral->save();
                }

                Yii::$app->session->setFlash('success', 'Thank you for signing up. Please check your email for verification link.');
                return $this->redirect(['/login']);
            } else {
                Yii::$app->session->setFlash('error', 'There was an error during signup. Please try again.');
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionVerification()
    {
        $this->layout="login_layout";
        $user = Yii::$app->user->identity;
        return $this->render('verification', [
            'user' => $user,
        ]);
    }

    public function actionVerify()
    {
        // get url link
        $verificationUrl = Yii::$app->request->getAbsoluteUrl();
        $userToVerify = UserVerifications::find()
            ->where(['email_verification_link' => $verificationUrl])
            ->orderBy(['created_at' => SORT_DESC])
            ->one();
        if ($userToVerify) {
            if ($userToVerify->email_verification_expires < date('Y-m-d H:i:s')) {
                Yii::$app->session->setFlash('error', 'Verification link has expired.');
                return $this->redirect(['/login']);
            }

            $user = User::findOne($userToVerify->user_id);

            $userToVerify->email_verified = 1;
            $attempts = $userToVerify->email_verification_attempts + 1;
            $userToVerify->email_verification_attempts = $attempts;
            $userToVerify->save();

            $isReffered = Referrals::find()->where(['referred_user_id' => $user->id])->one();
            if ($isReffered) {
                $isReffered->referral_status = "Verified";
                $isReffered->save();

                $coins = 50;
                Wallet::Credit($isReffered->referrer_id, $coins, "recieved", "Recieved on referral approch.");
            }

            if ($user instanceof \yii\web\IdentityInterface) {
                $user->verification = 1;
                $user->save();
                Yii::$app->user->login($user);
                if ($user->role === 'student') {
                 
                        return $this->redirect(['profile/create']); 
                       
                } elseif ($user->role === 'tutor') {
                    return $this->redirect(['tutor/teacher-profile']);
                }
                // return $this->goHome();
            }
        } else {
            echo 'no link found';
        }
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
