<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
use yii\helpers\Html;
// Get the current page name to highlight active link
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!-- Main Navigation -->
<nav class="profile-main-nav">
    <div class="profile-container">
        <div class="profile-nav-content">
            <div class="profile-nav-left">
                <a href="index.php" class="profile-logo">
                    <img src="<?= Yii::getAlias('@web') ?>/assets/images/profile-logo.png" alt="Tutor Expert" class="profile-logo-image">
                </a>
                
                <!-- Hamburger Menu Button -->
                <button class="profile-mobile-toggle" aria-label="Toggle menu" aria-expanded="false">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>

                <!-- Navigation Links - Now wrapped in a container for mobile -->
                <div class="profile-nav-links-container">
                    <!-- Close button for mobile -->
                    <button class="profile-nav-close" aria-label="Close menu">
                        <i class="fas fa-times"></i>
                    </button>
                    
                    <div class="profile-nav-links">
                        <a href="profile.php" class="<?php echo $current_page === 'profile' ? 'active' : ''; ?>">Profile</a>
                        <a href="messages.php" class="<?php echo $current_page === 'messages' ? 'active' : ''; ?>">Messages</a>
                        <a href="delivery.php" class="<?php echo $current_page === 'delivery' ? 'active' : ''; ?>">Delivery Work</a>
                        <a href="finance.php" class="<?php echo $current_page === 'finance' ? 'active' : ''; ?>">Manage Finance</a>
                        <a href="teacher-reviews.php" class="<?php echo $current_page === 'reviews' ? 'active' : ''; ?>">Reviews</a>
                    </div>

                    <!-- Mobile-only user info -->
                    <div class="profile-user-info mobile-only">
                        <img src="<?= Yii::getAlias('@web') ?>/assets/images/profile.jpg" alt="<?= Yii::$app->user->identity->username ?>" class="profile-user-pic">
                        <span class="profile-user-name"><?= Yii::$app->user->identity->username ?></span>
                        <i class="fas fa-user profile-verification-badge"></i>
                    </div>
                </div>
            </div>

            <!-- Desktop user info -->
            <div class="profile-user-info desktop-only">
                <img src="<?= Yii::getAlias('@web') ?>/assets/images/profile.jpg" alt="<?= Yii::$app->user->identity->username ?>" class="profile-user-pic">
                <span class="profile-user-name"><?= Yii::$app->user->identity->username ?></span>
                <i class="fas fa-user profile-verification-badge"></i>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div class="profile-mobile-overlay"></div>