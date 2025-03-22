<?php

namespace app\controllers;

use app\models\ChatMessages;
use app\models\PostMessages;
use app\models\StudentJobPosts;
use app\models\User;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use Yii;


class ChatController extends Controller
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
                'tutor' => ['chat', 'peoples'],
                'student' => ['chat', 'peoples'],
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionPeoples()
    {
        $myId = Yii::$app->user->identity->id;

        $peoples = (new \yii\db\Query())
            ->select(['u.id', 'u.username', 'u.email', 'u.role'])
            ->from(['u' => 'users'])
            ->innerJoin(
                ['cm' => 'chat_messages'],
                'u.id = cm.sender_id OR u.id = cm.receiver_id'
            )
            ->where([
                'or',
                ['cm.sender_id' => $myId],
                ['cm.receiver_id' => $myId]
            ])
            ->andWhere(['!=', 'u.id', $myId]) // Exclude myself
            ->distinct()
            ->all();

        return $this->render('peoples', [
            'peoples' => $peoples,
        ]);
    }

    public function actionChat()
    {
        $secretKey = "random1000secret1000keys";
        $otherId = Yii::$app->request->get("other");
        $myId = Yii::$app->user->identity->id;
        $postId = Yii::$app->request->get("post");

        $post = null;
        if (!empty($postId)) {
            $post = StudentJobPosts::findOne($postId);
        }

        $other = User::findOne($otherId);

        $messages = ChatMessages::find()
            ->with(['sender'])
            ->where([
                'or',
                ['and', ['sender_id' => $otherId], ['receiver_id' => $myId]],
                ['and', ['sender_id' => $myId], ['receiver_id' => $otherId]]
            ])
            ->orderBy(['created_at' => SORT_ASC])
            ->all();


        $peoples = (new \yii\db\Query())
            ->select(['u.id', 'u.username', 'u.email', 'u.role'])
            ->from(['u' => 'users'])
            ->innerJoin(
                ['cm' => 'chat_messages'],
                'u.id = cm.sender_id OR u.id = cm.receiver_id'
            )
            ->where([
                'or',
                ['cm.sender_id' => $myId],
                ['cm.receiver_id' => $myId]
            ])
            ->andWhere(['!=', 'u.id', $myId]) // Exclude myself
            ->distinct()
            ->all();

        return $this->render('chat', [
            'messages' => $messages,
            'peoples' => $peoples,
            'other' => $other,
            'post' => $post
        ]);
    }
}
