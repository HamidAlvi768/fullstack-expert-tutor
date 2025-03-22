<?php

namespace app\controllers;

use Yii;
use app\models\Profiles;
use app\models\User;
use app\models\UserVerifications;
use yii\debug\models\search\Profile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * ProfilesController handles CRUD actions for Profiles model.
 */
class ProfileController extends Controller
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
                'tutor' => ['teacher-profile', 'subject-teach', 'education-experience', 'professional-experience', 'teaching-details', 'teacher-description'],
                'student' => ['view', 'create', 'update'],
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
        $this->layout = 'student_layout';
        $user = User::find()->where(['profile'])->where(['id' => Yii::$app->user->identity->id]);

        return $this->render('index', [
            'user' => $user,
        ]);
    }

    public function actionView()
    {
        $this->layout = 'student_layout';
        $id = Yii::$app->user->identity->id;
        $model = Profiles::find()->where(['user_id' => $id])->one();
        if (!$model) {
            return $this->redirect(['create']);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $this->layout = 'student_layout';
        // Check is profile details created
        $id = Yii::$app->user->identity->id;
        $model = Profiles::find()->where(['user_id' => $id])->one();
        if ($model) {
            return $this->redirect(['view']);
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
                    return $this->redirect(['post/create']);
                    // return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate()
    {
        $this->layout = 'student_layout';
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
