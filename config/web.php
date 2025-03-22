<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'exprt_tutor_secret_key',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => false,
            'transport' => [
                'scheme' => 'smtps',
                'host' => 'mail.leightonbuzzardairportcabs.co.uk', // SMTP server
                'username' => 'twenty47logistics@leightonbuzzardairportcabs.co.uk',
                'password' => 'twenty47logistics',
                'port' => '465',
                'encryption' => 'tsl',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/log-user-leaving' => 'site/log-user-leaving',
                '' => 'site/index',
                '/login' => 'site/login',
                '/signup' => 'site/signup',
                '/logout' => 'site/logout',
                '/verification' => 'site/verification',
                '/verify' => 'site/verify',
                '/verify-phone' => 'user/verify-phone',
                '/profile/create' => 'profile/create',
                '/profile/edit' => 'profile/update',
                '/profile' => 'profile/view',
                '/peoples' => 'chat/peoples',
                '/peoples/chat' => 'chat/chat',
                '/tutors' => 'site/tutors',
                '/tutor-profile' => 'site/tutor-profile',

                // Tutor
                '/tutor/profile' => 'tutor/teacher-profile',
                '/tutor/subjects' => 'tutor/subject-teach',
                '/tutor/education' => 'tutor/education-experience',
                '/tutor/professional-experience' => 'tutor/professional-experience',
                '/tutor/teaching-details' => 'tutor/teaching-details',
                '/tutor/description' => 'tutor/teacher-description',
                '/tutor/wallet/coins' => 'tutor/get-coins',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
