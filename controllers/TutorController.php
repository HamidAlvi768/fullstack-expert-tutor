<?php

namespace app\controllers;

use app\components\Helper;
use app\models\Coins;
use app\models\JobApplications;
use Yii;
use app\models\Profiles;
use app\models\Referrals;
use app\models\StudentJobPosts;
use app\models\TeacherEducation;
use app\models\TeacherJobDescriptions;
use app\models\TeacherProfessionalExperience;
use app\models\TeacherSubjects;
use app\models\TeacherTeachingDetails;
use app\models\User;
use app\models\UserReferralCodes;
use app\models\UserVerifications;
use app\models\Wallets;
use app\models\WalletTransactions;
use Stripe\FinancialConnections\Transaction;
use yii\data\Pagination;
use yii\debug\models\search\Profile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * ProfilesController handles CRUD actions for Profiles model.
 */
class TutorController extends Controller
{
    public function beforeAction($action)
    {
        $actionId = $action->id;
        $controllerId = $this->id;

        // PUBLIC ACTIONS
        $publicActions = ['index', 'contact', 'verify', 'about', 'login', 'signup', 'error'];

        // Check if user is guest and trying to access restricted area
        if (Yii::$app->user->isGuest && !in_array($actionId, $publicActions)) {
            Yii::$app->session->setFlash('error', 'Please login to access this page.');
            Yii::$app->response->redirect(['/login'])->send();
            return false;
        }

        // echo Yii::$app->user->isGuest ? "Guest" : "Logged User";
        // die;

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
                'tutor' => [
                    'teacher-profile',
                    'subject-teach',
                    'education-experience',
                    'professional-experience',
                    'teaching-details',
                    'teacher-description',
                    'dashboard',
                    'job-apply',
                    'apply-now',
                    'wallet',
                    'get-coins',
                    'payment-success',
                    'referrals'
                ],
                'student' => ['view', 'create', 'update'],
            ];

            // Check if user has permission
            if (!in_array($actionId, $permissions[$userRole]) && $permissions[$userRole] !== ['*']) {
                Yii::$app->session->setFlash('error', 'You do not have permission to access this page.');
                return $this->redirect(['/']);
            }
        }

        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Profiles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = User::find()->where(['profile'])->where(['id' => Yii::$app->user->identity->id]);

        return $this->render('index', [
            'user' => $user,
        ]);
    }

    private function checkAndCreateWallet($id)
    {
        // Check Wallet
        $wallet = Wallets::find()->where(['user_id' => $id])->one();
        if (!$wallet) {
            $depositCoins = 100;

            $wallet = new Wallets();
            $wallet->user_id = $id;
            $wallet->balance = 0;
            $wallet->currency = "Coins";
            $wallet->active = 1;
            $wallet->save();

            // TRANSACTION RECORD
            $transaction = new WalletTransactions();
            $transaction->wallet_id = $wallet->id;
            $transaction->transaction_type = "credit";
            $transaction->amount = $depositCoins;
            $transaction->description = "{$depositCoins} Coins deposit on account signup.";
            $transaction->status = "recieved";
            $transaction->save();
        }
    }

    public function actionTeacherProfile()
    {
        $this->layout = 'student_layout';

        // Check is profile details created
        $id = Yii::$app->user->identity->id;

        $model = Profiles::find()->where(['user_id' => $id])->one();
        if ($model) {
            return $this->redirect(['/tutor/subjects']);
        }

        $model = new Profiles();
        if (Yii::$app->request->isPost) {

            if ($model->load(Yii::$app->request->post())) {
                $model->user_id = $id;

                // // Handle image upload
                // $model->avatarFile = UploadedFile::getInstance($model, 'avatarFile');

                // // If an image is uploaded, save it and update the avatar_url
                // if ($model->avatarFile) {
                //     $avatarPath = $model->uploadAvatar();
                //     if ($avatarPath) {
                //         $model->avatar_url = $avatarPath;  // Save the path to avatar_url
                //     }
                // }

                if ($model->save()) {
                    $userVerification = UserVerifications::find()->where(['user_id' => $id])->one();
                    if ($userVerification) {
                        $otpCode = str_pad(random_int(0, 999999), 5, '0', STR_PAD_LEFT);
                        $userVerification->phone_number = $model->phone_number;
                        $userVerification->phone_verification_code = $otpCode;
                        $userVerification->phone_verified = 0;
                        $userVerification->save();
                    }
                    return $this->redirect(['/tutor/subjects', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionSubjectTeach()
    {
        $this->layout = 'student_layout';

        // Check is profile details created
        $id = Yii::$app->user->identity->id;

        $model = TeacherSubjects::find()->where(['teacher_id' => $id])->one();
        if ($model) {
            return $this->redirect(['/tutor/education-experience']);
        }

        $model = new TeacherSubjects();
        if (Yii::$app->request->isPost) {

            $data = Yii::$app->request->post('TeacherSubjects');
            $subject = $data['subject'];
            $from_level = $data['from_level'];
            $to_level = $data['to_level'];

            if (count($subject) > 0) {
                // var_dump($subject);exit();

                for ($i = 0; $i < count($subject); $i++) {
                    $teacherSubject = new TeacherSubjects();
                    $teacherSubject->teacher_id = $id;
                    $teacherSubject->subject = $subject[$i];
                    $teacherSubject->from_level = $from_level[$i];
                    $teacherSubject->to_level = $to_level[$i];
                    $saved = $teacherSubject->save();
                }
                return $this->redirect(['/tutor/education-experience', 'id' => $model->id]);
            }
            // var_dump('pass');exit();
        }

        return $this->render('teacher-subjects', [
            'model' => $model,
        ]);
    }

    public function actionEducationExperience()
    {
        $this->layout = 'student_layout';

        // Check is profile details created
        $id = Yii::$app->user->identity->id;

        $model = TeacherEducation::find()->where(['teacher_id' => $id])->one();
        if ($model) {
            return $this->redirect(['/tutor/professional-experience']);
        }

        $model = new TeacherEducation();
        if (Yii::$app->request->isPost) {

            $data = Yii::$app->request->post('TeacherEducation');
            $institute_name = $data['institute_name'];
            $degree_type = $data['degree_type'];
            $degree_name = $data['degree_name'];
            $start_date = $data['start_date'];
            $end_date = $data['end_date'];
            $association = $data['association'];
            $specialization = $data['specialization'];

            if (count($institute_name) > 0) {

                for ($i = 0; $i < count($institute_name); $i++) {
                    $teacherSubject = new TeacherEducation();
                    $teacherSubject->teacher_id = $id;
                    $teacherSubject->institute_name = $institute_name[$i];
                    $teacherSubject->degree_type = $degree_type[$i];
                    $teacherSubject->degree_name = $degree_name[$i];
                    $teacherSubject->start_date = $start_date[$i];
                    $teacherSubject->end_date = $end_date[$i];
                    $teacherSubject->association = $association[$i];
                    $teacherSubject->specialization = $specialization[$i];
                    $saved = $teacherSubject->save();
                }
                return $this->redirect(['/tutor/professional-experience']);
            }
        }

        return $this->render('education-experience', [
            'model' => $model,
        ]);
    }

    public function actionProfessionalExperience()
    {
        $this->layout = 'student_layout';

        // Check is profile details created
        $id = Yii::$app->user->identity->id;

        $model = TeacherProfessionalExperience::find()->where(['teacher_id' => $id])->one();
        if ($model) {
            return $this->redirect(['/tutor/teaching-details']);
        }

        $model = new TeacherProfessionalExperience();
        if (Yii::$app->request->isPost) {

            $data = Yii::$app->request->post('TeacherProfessionalExperience');
            $organization = $data['organization'];
            $designation = $data['designation'];
            $start_date = $data['start_date'];
            $end_date = $data['end_date'];
            $association = $data['association'];
            $job_role = $data['job_role'];

            if (count($organization) > 0) {

                for ($i = 0; $i < count($organization); $i++) {
                    $teacherSubject = new TeacherProfessionalExperience();
                    $teacherSubject->teacher_id = $id;
                    $teacherSubject->organization = $organization[$i];
                    $teacherSubject->designation = $designation[$i];
                    $teacherSubject->start_date = $start_date[$i];
                    $teacherSubject->end_date = $end_date[$i];
                    $teacherSubject->association = $association[$i];
                    $teacherSubject->job_role = $job_role[$i];
                    $saved = $teacherSubject->save();
                }
                return $this->redirect(['/tutor/teaching-details']);
            }
        }

        return $this->render('professional-experience', [
            'model' => $model,
        ]);
    }

    public function actionTeachingDetails()
    {
        $this->layout = 'student_layout';

        // Check is profile details created
        $id = Yii::$app->user->identity->id;

        $model = TeacherTeachingDetails::find()->where(['teacher_id' => $id])->one();
        if ($model) {
            return $this->redirect(['/tutor/description']);
        }

        $model = new TeacherTeachingDetails();

        if ($model->load(Yii::$app->request->post())) {
            $model->teacher_id = $id;

            if ($model->save()) {
                return $this->redirect(['/tutor/description']);
            }
        }

        return $this->render('teaching-details', [
            'model' => $model,
        ]);
    }

    public function actionTeacherDescription()
    {
        $this->layout = 'student_layout';

        // Check is profile details created
        $id = Yii::$app->user->identity->id;

        $model = TeacherJobDescriptions::find()->where(['teacher_id' => $id])->one();
        if ($model) {
            return $this->redirect(['/tutor/dashboard']);
        }

        $model = new TeacherJobDescriptions();

        if ($model->load(Yii::$app->request->post())) {
            $model->teacher_id = $id;

            if ($model->save()) {
                return $this->redirect(['/tutor/dashboard']);
            }
        }

        return $this->render('teacher-description', [
            'model' => $model,
        ]);
    }

    public function actionDashboard()
    {
        $this->layout = "tutor_layout";
        $id = Yii::$app->user->identity->id;
        $user = User::findOne($id);

        // Check and create wallet
        $this->checkAndCreateWallet($id);

        // Post Matches
        $matched_posts = StudentJobPosts::find()->all();

        return $this->render('dashboard', [
            'user' => $user,
            'matched_posts' => $matched_posts
        ]);
    }

    public function actionJobApply()
    {
        $this->layout = "tutor_layout";
        $id = Yii::$app->user->identity->id;
        $user = User::findOne($id);
        $job_id = Yii::$app->request->get("id");

        // Post Matches
        $post = StudentJobPosts::find()->with(['applies'])->where(['id' => $job_id])->one();
        $applied = JobApplications::find()->where(['job_id' => $job_id, 'applicant_id' => $id])->one();
        $coins = Wallets::find()->where(['user_id' => $id])->one();

        return $this->render('job-apply', [
            'user' => $user,
            'post' => $post,
            'applied' => $applied,
            'coins' => $coins
        ]);
    }

    public function actionApplyNow()
    {
        $id = Yii::$app->user->identity->id;
        $redirectUrl = Yii::$app->request->get("url");
        $job_id = Yii::$app->request->get("id");
        $coins = Yii::$app->request->get("coins");
        $postId = Yii::$app->request->get("post");

        $applied = JobApplications::find()->where(['job_id' => $job_id, 'applicant_id' => Yii::$app->user->identity->id])->one();
        if (!$applied) {
            $userWallet = Wallets::find()->where(['user_id' => $id])->one();
            if ($userWallet->balance >= $coins) {
                $userWallet->balance -= $coins;
                $userWallet->save();

                // TRANSACTION RECORD
                $transaction = new WalletTransactions();
                $transaction->wallet_id = $userWallet->id;
                $transaction->transaction_type = "debit";
                $transaction->amount = $coins;
                $transaction->description = "Paid for a message during job apply";
                $transaction->status = "paid";
                $transaction->save();

                $application = new JobApplications();
                $application->job_id = $job_id;
                $application->applicant_id = $id;
                $application->save();
            }
        }

        Yii::$app->response->redirect($redirectUrl . "&post=" . $postId)->send();
    }


    public function actionWallet()
    {
        $this->layout = "tutor_layout";
        $id = Yii::$app->user->identity->id;

        // Post Matches
        $user = User::find()->with(['wallet'])->where(['id' => $id])->one();
        $wallet = Wallets::find()->with(['transactions'])->where(['user_id' => $id])->one();

        return $this->render('wallet', [
            'user' => $user,
            'wallet' => $wallet
        ]);
    }
    public function actionGetCoins()
    {
        $this->layout = "tutor_layout";
        $id = Yii::$app->user->identity->id;
        // Post Matches
        $user = User::find()->with(['wallet'])->where(['id' => $id])->one();
        $coins = Coins::find()->all();

        if (Yii::$app->request->isPost) {
            $coinId = Yii::$app->request->post('coin');

            $coin = Coins::findOne($coinId);
            Yii::$app->session->set('coin', $coin);
            Yii::$app->response->redirect(['/payment/stripe-payment'])->send();
        }

        return $this->render('coins', ['coins' => $coins, 'user' => $user]);
    }

    public function actionPaymentSuccess()
    {
        $paymentId = Yii::$app->session->get('id');
        $id = Yii::$app->request->get('id');
        $userId = Yii::$app->user->identity->id;
        if ($id == $paymentId) {
            $coin = Yii::$app->session->get('coin');
            Yii::$app->session->remove('coin');
            $depositCoins = $coin['coin_count'];
            $wallet = Wallets::find()->where(['user_id' => $userId])->one();
            $wallet->balance += $depositCoins;
            $wallet->save();
            // TRANSACTION RECORD
            $transaction = new WalletTransactions();
            $transaction->wallet_id = $wallet->id;
            $transaction->transaction_type = "credit";
            $transaction->amount = $depositCoins;
            $transaction->description = "{$depositCoins} Coins purchased.";
            $transaction->status = "recieved";
            $transaction->save();
        }
        Yii::$app->response->redirect(['/tutor/wallet'])->send();
    }

    public function actionReferrals()
    {
        $id = Yii::$app->user->identity->id;
        $user = User::findOne($id);


        $code = UserReferralCodes::find()->where(['user_id' => $id])->one();
        if (!$code) {
            $referralCode = Helper::generateReferralCode(Yii::$app->user->identity->username, $id);

            $code = new UserReferralCodes();
            $code->user_id = $id;
            $code->referral_code = $referralCode;
            $code->save();
        }

        // FIND Referrals
        $query = Referrals::find()->with(['user'])->where(['referrer_id' => $id]);

        // Create Pagination object
        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 10,
        ]);

        $referrals = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('referrals', [
            'referrals' => $referrals,
            'code' => $code,
            'pagination' => $pagination
        ]);
    }

    public function actionUpdate()
    {
        $id = Yii::$app->user->identity->id;
        $model = Profiles::find()->where(['user_id' => $id])->one();
        if (!$model) {
            return $this->redirect(['create']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Profiles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested profile does not exist.');
    }
}
