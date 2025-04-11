<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Connect - Connect Individuals to Assign</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login-modal.css">
</head>

<body>
    <div class="page-wrapper">

        <style>
            .page-wrapper {
                background-color: #f5f5f5;
                min-height: 100vh;
            }

            .login-page {
                width: 100%;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .login-form-panel {
                border-radius: 0px 15px 15px 0px;
                background: #fff;
            }

            .login-image-panel {
                height: 100%;
                overflow: hidden;
            }

            @media screen and (max-width:768px) {
                .login-page {
                    padding: 10px;
                }

                .login-form-panel {
                    border-radius: 15px;
                }
            }
        </style>
        <?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

        $type = 'login';
        $isLogin = $type === 'login';
        $modalId = 'loginModal';
        $title = 'Login your account!';
        $submitText = 'Continue';
        $alternateText = 'Don\'t have an account?';
        $alternateLink = 'Sign up';
        $alternateLinkTarget = '#signupModal';
        ?>
        <div class="login-page modal-dialog">
            <div class="modal-content">
                <div class="row g-0" style="overflow: hidden;">
                    <!-- Left Image Panel -->
                    <div class="col-md-6 d-none d-md-block">
                        <div class="login-image-panel" style="border-radius: 15px 0px 0px 15px;">
                            <img src="<?= Yii::getAlias('@web') ?>/assets/images/student-login.jpg"
                                alt="Login illustration"
                                class="img-fluid h-100 w-100 object-fit-cover"
                                style="height: 100%;"
                                id="auth-image">
                        </div>
                    </div>
                    <!-- Right Form Panel -->
                    <div class="col-md-6">
                        <div class="login-form-panel p-4 p-md-5">
                            <h2 class="login-title mb-4"><?php echo $title; ?></h2>

                            <!-- Auth Method Tabs -->
                            <div class="login-method-tabs mb-4">
                                <button class="btn active" data-method="email">E-mail</button>
                                <button class="btn" data-method="mobile">Mobile Number</button>
                            </div>

                            <!-- Auth Form -->
                           
                               
                            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"input-group\">\n<span class=\"input-group-text\"><i class=\"fas {fa_icon}\"></i></span>\n{input}\n</div>\n{error}",
                    'labelOptions' => ['class' => 'form-label'],
                    'inputOptions' => ['class' => 'form-control'],
                    'errorOptions' => ['class' => 'invalid-feedback'],
                ],
                'options' => ['class' => 'auth-form'],
            ]); ?>

                                <!-- Email Input Group -->
                                <div class="form-group mb-3" id="email-input-group">
                                    <?= $form->field($model, 'email', [
                                        'options' => ['class' => false],
                                        'inputOptions' => ['placeholder' => 'Enter your username', 'autofocus' => true],
                                        'parts' => [
                                            '{fa_icon}' => 'fa-envelope'
                                        ]
                                    ])->textInput() ?>
                                </div>

                                <!-- Password Input Group -->
                                <div class="form-group mb-3">
                                    <?= $form->field($model, 'password', [
                                        'options' => ['class' => false],
                                        'inputOptions' => ['placeholder' => 'Enter your password'],
                                        'parts' => [
                                            '{fa_icon}' => 'fa-lock'
                                        ]
                                    ])->passwordInput() ?>
                                </div>

                                <?php if ($isLogin): ?>
                                    <div class="text-end mb-3">
                                        <a href="#" class="forgot-password">Forgot password?</a>
                                    </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100']) ?>
                                </div>

                            <?php ActiveForm::end(); ?>

                            <!-- Social Login -->
                            <div class="social-login text-center mt-4">
                                <p class="text-muted mb-3">Sign in With</p>
                                <div class="social-icons mb-4">
                                    <button class="btn btn-social facebook" type="button">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>
                                    <button class="btn btn-social google" type="button">
                                        <img src="<?= Yii::getAlias('@web') ?>/assets/images/icons/google.svg" alt="Google" width="20" height="20">
                                    </button>
                                    <button class="btn btn-social apple" type="button">
                                        <i class="fab fa-apple"></i>
                                    </button>
                                </div>
                                <p class="signup-text">
                                    <?php echo $alternateText; ?>
                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/signup']) ?>" class="<?php echo $isLogin ? 'signup-link' : 'login-link'; ?>">
                                        <?php echo $alternateLink; ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS and other scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/login-modal.js"></script>
</body>

</html>