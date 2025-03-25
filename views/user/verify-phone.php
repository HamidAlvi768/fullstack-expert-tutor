<?php

use app\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Phone Verification';

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/profile.css');

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
        }
        
        .expertTutor_myRequests_price {
            font-weight: 600;
            font-size: 1.25rem;
            margin-right: 15px;
            margin-top: -0.7rem;
        }
        
        .expertTutor_myRequests_currency {
            display: inline-flex;
            align-items: center;
            margin-right: 4px;
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
            margin-bottom: 10px;
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

        .resend-link:hover, .change-phone-link:hover {
            text-decoration: underline;
        }

        .verification-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>






<!-- <h2><?= Html::encode($this->title) ?></h2> -->
<div id="phoneVerificationModal" class="verification-container">
        <div class="phone-verification-overlay"></div>
        <div class="phone-verification-content">
            <div class="phone-icon-container">
                <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M36.7552 28.815V33.7621C36.757 34.2214 36.6629 34.676 36.479 35.0968C36.295 35.5176 36.0251 35.8953 35.6867 36.2058C35.3483 36.5163 34.9488 36.7526 34.5137 36.8998C34.0786 37.0469 33.6177 37.1016 33.1603 37.0602C28.0859 36.5088 23.2116 34.7749 18.9291 31.9977C14.9448 29.4659 11.5667 26.0878 9.0349 22.1035C6.248 17.8015 4.51365 12.9035 3.97237 7.80636C3.93116 7.35035 3.98536 6.89076 4.1315 6.45684C4.27765 6.02292 4.51254 5.62418 4.82124 5.28602C5.12993 4.94785 5.50565 4.67767 5.92448 4.49267C6.34331 4.30767 6.79608 4.2119 7.25395 4.21147H12.201C13.0013 4.20359 13.7772 4.48699 14.384 5.00883C14.9908 5.53068 15.3871 6.25536 15.4991 7.04781C15.7079 8.63099 16.0952 10.1855 16.6534 11.6816C16.8753 12.2718 16.9233 12.9133 16.7918 13.53C16.6603 14.1466 16.3547 14.7127 15.9114 15.1611L13.8171 17.2553C16.1646 21.3838 19.5829 24.802 23.7113 27.1495L25.8056 25.0553C26.2539 24.6119 26.82 24.3063 27.4367 24.1748C28.0533 24.0433 28.6948 24.0913 29.285 24.3132C30.7812 24.8715 32.3356 25.2587 33.9188 25.4675C34.7199 25.5805 35.4514 25.984 35.9744 26.6012C36.4973 27.2184 36.7752 28.0063 36.7552 28.815Z" stroke="#564FFD" stroke-width="3.29807" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h2 class="verification-title">Check your Phone</h2>
            <p class="verification-text">Verification Code Sent on <?= ' '.$user->profile->phone_number; ?></p>
            <?php $form = \yii\widgets\ActiveForm::begin([
                'id' => 'otpForm',
                'options' => ['class' => 'form-horizontal'],
            ]); ?>
            <div class="verification-code-inputs">
                <?php for ($i = 1; $i <= 6; $i++): ?>
                    <input type="text"
                        class="otp-input code-input"
                        maxlength="1"
                        style="width: 50px; height: 50px; text-align: center; font-size: 24px;"
                        name="otp[]"
                        data-index="<?= $i ?>"
                        autocomplete="off">
                <?php endfor; ?>
            </div>

            <button type="submit" class="btn btn-primary" style="margin: 10px;">Verify</button>
            <?php \yii\widgets\ActiveForm::end(); ?>
            
            <div class="verification-help">
                <span>Didn't receive the Code?</span>
                <a href="#" class="resend-link">Code Resend</a>
            </div>
            
            <div class="change-phone">
                <a href="#" class="change-phone-link">Change Phone Number</a>
            </div>
        </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.otp-input');

        inputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                if (this.value.length >= 1) {
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                }
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !this.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    });
</script>