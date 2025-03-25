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
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .login-page {
                width: 100%;
                max-width: 1000px;
                margin: 1rem;
            }

            .modal-content {
                background: transparent;
                border: none;
            }

            .login-form-panel {
                border-radius: 0px 15px 15px 0px;
                background: #fff;
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            .login-image-panel {
                height: 100%;
                border-radius: 15px 0px 0px 15px;
                overflow: hidden;
            }

            .login-image-panel img {
                height: 100%;
                object-fit: cover;
            }

            .row {
                min-height: 600px;
                max-height: 90vh;
            }

            /* Additional signup specific styles */
            .signup-btn {
                width: 100%;
                margin-top: 1rem;
            }

            .field-signupform-role {
                margin-top: 0.5rem;
            }

            .field-signupform-role select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: 15px;
            }

            .field-signupform-role select:focus {
                border-color: #564FFD;
                box-shadow: none;
            }

            /* Compact form styles */
            .login-title {
                font-size: 1.5rem;
                margin-bottom: 1rem !important;
            }

            .login-method-tabs {
                margin-bottom: 1rem !important;
            }

            .form-group {
                margin-bottom: 0.75rem !important;
            }

            .social-login {
                margin-top: 1rem !important;
            }

            .social-icons {
                margin-bottom: 1rem !important;
            }

            /* Remove duplicate labels since we're using input groups */
            .form-group .form-label {
                display: none;
            }

            @media screen and (max-width: 768px) {
                .login-page {
                    margin: 0.5rem;
                }

                .login-form-panel {
                    border-radius: 15px;
                    padding: 1.5rem !important;
                }

                .row {
                    min-height: auto;
                }
            }
        </style>

        <?php
        /** @var yii\web\View $this */
        /** @var yii\bootstrap5\ActiveForm $form */
        /** @var app\models\SignupForm $model */

        use yii\bootstrap5\ActiveForm;
        use yii\bootstrap5\Html;

        $type = 'signup';
        $isLogin = $type === 'login';
        $modalId = 'signupModal';
        $title =  'Create your account!';
        $submitText = 'Sign Up';
        $alternateText =  'Already have an account?';
        $alternateLink = 'Login';
        $alternateLinkTarget = '#loginModal';
        ?>
        <div class="login-page modal-dialog">
            <div class="modal-content">
                <div class="row g-0">
                    <!-- Left Image Panel -->
                    <div class="col-md-6 d-none d-md-block">
                        <div class="login-image-panel">
                            <img src="<?= Yii::getAlias('@web') ?>/assets/images/student-login.jpg"
                                alt="Login illustration"
                                class="img-fluid w-100"
                                id="auth-image">
                        </div>
                    </div>
                    <!-- Right Form Panel -->
                    <div class="col-md-6">
                        <div class="login-form-panel p-4">
                            <!-- User Type Toggle -->
                            <div class="user-type-toggle mb-3">
                                <button class="btn active" id="studetn-btn" data-type="student">Student</button>
                                <button class="btn" id="teacher-btn" data-type="teacher">Teacher</button>
                            </div>

                            <h2 class="login-title"><?php echo $title; ?></h2>

                            <!-- Auth Method Tabs -->
                            <div class="login-method-tabs">
                                <button class="btn active" data-method="email">E-mail</button>
                                <button class="btn" data-method="mobile">Mobile Number</button>
                            </div>

                            <?php $form = ActiveForm::begin([
                                'id' => 'signup-form',
                                'fieldConfig' => [
                                    'template' => "{label}\n<div class=\"input-group\">\n<span class=\"input-group-text\"><i class=\"fas {fa_icon}\"></i></span>\n{input}\n</div>\n{error}",
                                    'labelOptions' => ['class' => 'form-label'],
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['class' => 'invalid-feedback'],
                                ],
                                'options' => ['class' => 'auth-form flex-grow-1'],
                            ]); ?>

                            <!-- Username Input Group -->
                            <div class="form-group mb-3">
                                <?= $form->field($model, 'username', [
                                    'options' => ['class' => false],
                                    'inputOptions' => ['placeholder' => 'Enter your username', 'autofocus' => true],
                                    'parts' => [
                                        '{fa_icon}' => 'fa-user'
                                    ]
                                ])->textInput() ?>
                            </div>

                            <!-- Email Input Group -->
                            <div class="form-group mb-3">
                                <?= $form->field($model, 'email', [
                                    'options' => ['class' => false],
                                    'inputOptions' => ['placeholder' => 'Enter your email'],
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

                            <!-- Role Selection -->
                            <div class="mb-3 field-signupform-role required">
                                <label class="form-label" for="signupform-role">Join as</label>
                                <?= $form->field($model, 'role', [
                                    'options' => ['class' => false],
                                ])->dropDownList(
                                    ['student' => 'Student', 'tutor' => 'Tutor'],
                                    ['prompt' => 'Select Join as', 'class' => 'form-control']
                                ) ?>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group">
                                <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary signup-btn']) ?>
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
                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>" class="<?php echo $isLogin ? 'signup-link' : 'login-link'; ?>">
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

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const studentBtn = document.querySelector("#studetn-btn");
            const teacherBtn = document.querySelector("#teacher-btn");
            const selectList = document.querySelector("#signupform-role");
            const options = selectList.querySelectorAll("option");
            options[1].selected = true;

            studentBtn.addEventListener("click", () => {
                if (!studentBtn.classList.contains("active")) {
                    studentBtn.classList.add("active");
                    teacherBtn.classList.remove("active");
                    options[1].selected = true;
                }
            })
            teacherBtn.addEventListener("click", () => {
                if (!teacherBtn.classList.contains("active")) {
                    teacherBtn.classList.add("active");
                    studentBtn.classList.remove("active");
                    options[2].selected = true;
                }
            })
        })
    </script>

    <!-- Bootstrap JS and other scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>