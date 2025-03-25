<?php
// Start session if not already started

use yii\helpers\Html;
?>
<style>
    .btn-link.logout {
        text-decoration: none;
        border: none;
        background: none;
        padding: 8px 0;
        color: var(--text-dark);
    }

    .btn-link.logout:hover {
        color: var(--primary-color);
    }
</style>
<!-- Top Header -->
<header class="profile-top-header">
    <div class="profile-container">
        <div class="profile-header-content">
            <div class="profile-top-nav">
                <?php if (Yii::$app->user->isGuest): ?>
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>" class="profile-nav-link">Sign In</a>
                <?php else: ?>
                    <?php
                        echo Html::beginForm(['/logout'], 'post');
                        echo Html::submitButton(
                            'Logout',
                            ['class' => 'btn btn-link logout']
                        );
                        echo Html::endForm();
                        ?>
                <?php endif; ?>
                <a href="support.php" class="profile-nav-link">Support</a>
                <a href="contact.php" class="profile-nav-link">Contact Sales</a>
            </div>
        </div>
    </div>
</header>