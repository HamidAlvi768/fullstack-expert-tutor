<?php

use app\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Email Verification';
$this->params['breadcrumbs'][] = $this->title;

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/verification.css');

?>

<div class="verification-page">
    <div class="verification-container">
        <img src="<?= Yii::getAlias('@web'); ?>/assets/images/learning-college.jpg" alt="Background decoration" class="background-image" />
        <section class="verification-card">
            <div class="verification-content">
                <header class="verification-header">
                    <div class="verification-icon">
                        <i class="far fa-envelope"></i>
                    </div>
                    <div class="header-text">
                        <h1 class="title"><?= Html::encode($this->title) ?></h1>
                        <p class="subtitle">We've sent a verification link to:</p>
                        <p class="email-address"><?= Html::encode($user->email); ?></p>
                    </div>
                </header>

                <?= Html::a('<span class="button-text">Open email app</span>', 'mailto:', [
                    'class' => 'primary-button',
                    'onclick' => 'openDefaultEmailClient()'
                ]) ?>

                <div class="resend-section">
                    <p class="resend-text">Didn't receive the email?</p>
                    <?= Html::a('<span class="link-text">Click to resend</span>', ['resend-verification', 'id' => $user->id], [
                        'class' => 'link-button'
                    ]) ?>
                </div>

                <?= Html::a('<i class="fas fa-arrow-left back-icon"></i><span class="back-text">Back to log in</span>', '../index.php?modal=login', [
                    'class' => 'back-button'
                ]) ?>
            </div>
        </section>
    </div>
</div>

<?php
$script = <<<JS
function resendVerification() {
    $.ajax({
        url: '<?= Url::to(['/resend-verification']) ?>',
        type: 'POST',
        success: function(response) {
            alert('Verification email has been resent. Please check your inbox.');
        },
        error: function() {
            alert('Failed to resend verification email. Please try again later.');
        }
    });
}
JS;
$this->registerJs($script);
?></div>