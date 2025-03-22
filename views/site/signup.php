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
            .login-page {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #aeaeae99;
                padding: 45px;
            }

            .login-form-panel {
                border-radius: 0px 15px 15px 0px;
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
        <div class="login-page">
            <div class="row g-0" style="overflow: hidden;">
                <!-- Left Image Panel -->
                <div class="col-md-6 d-none d-md-block">
                    <div class="login-image-panel" style="border-radius: 15px 0px 0px 15px;overflow:hidden">
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
                        <!-- User Type Toggle -->
                        <div class="user-type-toggle mb-4">
                            <button class="btn active" id="studetn-btn" data-type="student">Student</button>
                            <button class="btn" id="teacher-btn" data-type="teacher">Teacher</button>
                        </div>

                        <h2 class="login-title mb-4"><?php echo $title; ?></h2>

                        <!-- Auth Method Tabs -->
                        <div class="login-method-tabs mb-4">
                            <button class="btn active" data-method="email">E-mail</button>
                            <button class="btn" data-method="mobile">Mobile Number</button>
                        </div>

                        <!-- Auth Form -->
                        
                           

                        <?php $form = ActiveForm::begin([
            'id' => 'signup-form',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'form-label'],
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'invalid-feedback'],
            ],
        ]); ?>
<div class="form-group mb-3">
    <div class="input-group">
        <span class="input-group-text">
            <i class="fas fa-user"></i>
        </span>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Enter your username']) ?>
    </div>
</div>
<div class="form-group mb-3">
    <div class="input-group">
        <span class="input-group-text">
            <i class="fas fa-envelope"></i>
        </span>
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Enter your email']) ?>

    </div>
</div>
<div class="form-group mb-3">
    <div class="input-group">
        <span class="input-group-text">
            <i class="fas fa-lock"></i>
        </span>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Enter your password']) ?>
    </div>
</div>
<div class="mb-3 field-signupform-role required">
    <label class="form-label" for="signupform-role">Join as</label>
    <?= $form->field($model, 'role')->dropDownList(
            ['student' => 'Student', 'tutor' => 'Tutor'],
            ['prompt' => 'Select Join as', 'class' => 'form-control']
        ) ?>
</div>
<div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary signup-btn']) ?>
        </div>

        <?php ActiveForm::end(); ?>
                            <!-- Social Login -->
                            <div class="social-login text-center">
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
                        </form>
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
    <!-- <script src="assets/js/main.js"></script> -->
    <!-- <script src="assets/js/login-modal.js"></script> -->
</body>

</html>