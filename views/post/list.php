<?php

use app\components\Helper;
use app\models\UserVerifications;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Student Job Posts';
$this->params['breadcrumbs'][] = $this->title;

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/profile.css');
// echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile-nav.js');

?>
<style>
    body {
        background-color: #ffffff;
        font-family: 'Poppins', sans-serif;
    }

    /* Add class to hide background pseudo-elements */
    body.no-bg::before,
    body.no-bg::after {
        opacity: 0 !important;
    }

    .expertTutor_myRequests_container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .expertTutor_myRequests_notification {
        background-color: #FF6B6B;
        color: white;
        border-radius: 8px;
        margin: 20px auto;
        width: 87vw;
        margin-top: -1rem;
        border: 1px solid #FF0000;
    }

    .expertTutor_myRequests_notification .alert-icon {
        width: 24px;
        height: 24px;
    }

    .expertTutor_myRequests_card {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 25px;
        margin-bottom: 20px;
        width: -webkit-fill-available;
    }

    .expertTutor_myRequests_card .request-message {
        text-decoration: none;
        color: #09B31A !important;
    }

    .expertTutor_myRequests_card a {
        text-decoration: none;
    }

    .expertTutor_myRequests_card .card-title {
        font-size: 2rem;
        font-weight: 600;
    }

    .expertTutor_myRequests_price {
        font-weight: 600;
        font-size: 1.25rem;
        margin-right: 15px;
    }

    .expertTutor_myRequests_currency {
        display: inline-flex;
        align-items: center;
        margin-right: 4px;
        color: #564FFD;
    }

    .expertTutor_myRequests_currency svg {
        width: auto;
        min-height: 2rem;
        transform: translate(4px, 10px);
    }

    .expertTutor_myRequests_currency svg path {
        stroke: #0891B2;
    }

    .expertTutor_myRequests_location {
        color: #6B7280;
        display: flex;
        align-items: center;
    }

    .expertTutor_myRequests_location .location-icon {
        width: 20px;
        height: 20px;
        margin-right: 8px;
        color: #09B31A;
    }

    .expertTutor_myRequests_finishButton {
        background-color: #6366F1;
        border: none;
        color: white;
        padding: 10px 25px;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.2s;
    }

    .expertTutor_myRequests_finishButton:hover {
        background-color: #4F46E5;
        color: white;
        text-decoration: none;
    }

    @media (max-width: 991.98px) {

        .expertTutor_myRequests_verifyButton,
        .expertTutor_myRequests_finishButton {
            margin: 1rem auto;
        }
    }

    .expertTutor_myRequests_verifyButton {
        background: white;
        color: black !important;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s;
        text-decoration: none;
    }

    .expertTutor_myRequests_verifyButton:hover {
        background: #f8f9fa;
    }

    /* Phone Verification Modal Styles */
    .phone-verification-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .phone-verification-modal.active {
        display: flex;
    }

    .phone-verification-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .phone-verification-content {
        position: relative;
        background: white;
        border-radius: 24px;
        padding: 40px 50px;
        width: 100%;
        max-width: 650px;
        text-align: center;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        z-index: 1001;
    }

    .phone-icon-container {
        width: 84px;
        height: 84px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        border: 17.88px solid #F9F5FF;
        background: #F4EBFF;
    }

    .phone-icon-container svg {
        width: 32px;
        height: 32px;
    }

    .verification-title {
        font-size: 24px;
        font-weight: 600;
        color: #1B1B3F;
        margin-bottom: 8px;
    }

    .verification-text {
        font-size: 16px;
        color: #6F6F6F;
        margin-bottom: 24px;
    }

    .verification-code-inputs {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 28px;
    }

    .code-input {
        width: 54px;
        height: 54px;
        border: 1px solid #E7E7E7;
        border-radius: 8px;
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        color: #1B1B3F;
        background: #FFFFFF;
    }

    .code-input:focus {
        outline: none;
        border-color: #564FFD;
        box-shadow: 0 0 0 2px rgba(86, 79, 253, 0.1);
    }

    .verification-help {
        margin-bottom: 20px;
        font-size: 14px;
        color: #6F6F6F;
    }

    .resend-link {
        color: #564FFD;
        font-weight: 500;
        text-decoration: none;
        margin-left: 4px;
    }

    .change-phone-link {
        color: #FF6B6B;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
    }

    .resend-link:hover,
    .change-phone-link:hover {
        text-decoration: underline;
    }

    .page-title-section {
        display: none !important;
    }
</style>

<body class="no-bg">
    <?php
    $isNumberVerified = false;
    $userVerification = UserVerifications::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
    $isNumberVerified = $userVerification->phone_verified == 1 ? true : false;
    ?>
    <div class="container mt-4 mb-5">
        <?php if (!$isNumberVerified): ?>

            <div class="expertTutor_myRequests_notification p-2">
                <div class="d-flex align-items-center justify-content-between" style="flex-wrap: wrap;">
                    <div class="d-flex align-items-center" style="margin-left: 1rem;">
                        <svg class="alert-icon me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="mb-0" style="font-size: 0.9rem;">Please Take A Moment To Verify Your Phone Number To Connect Tutor Easily</p>
                    </div>
                    <!-- <button id="verifyPhoneBtn" class="expertTutor_myRequests_verifyButton">Verify Phone Number</button> -->
                    <?= Html::a('Verify Phone Number', ['/verify-phone'], ['class' => 'expertTutor_myRequests_verifyButton', 'id' => 'verifyPhoneBtn']) ?>
                </div>
            </div>

        <?php endif; ?>


        <div class="d-flex justify-content-between align-items-center mb-4 page-title-section">
            <h2 class="mb-0"><?= Html::encode($this->title) ?></h2>
            <?php if ($isNumberVerified): ?>
                <div>
                    <?= Html::a('Create Job Post', ['create'], ['class' => 'btn btn-success']) ?>
                </div>
            <?php endif; ?>
        </div>



        <!-- Request Card -->
        <?php foreach ($models as $model): ?>
            <div class="expertTutor_myRequests_card">

                <div class="" style="display: flex;justify-content:space-between;">
                    <h5 class="card-title"><?= Html::encode($model->title) ?></h5>
                    <a href="<?php echo Helper::baseUrl("/post/engagements?id={$model->id}"); ?>">
                        <span><i class="far fa-envelope request-message"></i></span>
                        <span style="font-size: 0.8rem;"><?php echo count($model->getMessages()->all());  ?></span>
                    </a>
                </div>

                <p class="text-secondary mb-4">
                    <?= Html::encode(substr($model->details, 0, 150)) . '...' ?>
                </p>

                <div class="d-flex align-items-center justify-content-between mt-4" style="flex-wrap: wrap;">
                    <div class="d-flex align-items-center">
                        <span class="expertTutor_myRequests_price">
                            <span class="expertTutor_myRequests_currency">PKR</span>
                            <?= Html::encode($model->budget) ?>
                        </span>
                        <span class="expertTutor_myRequests_location">
                            <svg class="location-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <?= Html::encode($model->location) ?>
                        </span>
                    </div>
                    <!-- <a href="#" class="expertTutor_myRequests_finishButton">
                        Finish
                    </a> -->
                    <?php if ($model->post_status !== 'finished'): ?>
                                <?= Html::a('Mark as Finished', ['finish-post', 'id' => $model->id], [
                                    'class' => 'expertTutor_myRequests_finishButton',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to mark this post as finished?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>



    </div>