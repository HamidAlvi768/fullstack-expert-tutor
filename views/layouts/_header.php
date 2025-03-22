<?php

use app\components\Helper;
use yii\helpers\Html;

?>
<?php
// Default logo settings if not provided
$logo_src = isset($custom_logo) ? $custom_logo : Yii::getAlias('@web').'/assets/images/logo.png';
$logo_alt = isset($custom_logo_alt) ? $custom_logo_alt : 'Assignment Connect';
?>
<header class="main-header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="<?php echo htmlspecialchars($logo_src); ?>" alt="Assignment By Teachers Logo" class="logo">
            </a>
            <!-- Hamburger Menu Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <!-- Main Navigation Links -->
                <ul class="navbar-nav" style="margin-left:4rem;">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="subjectsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Subjects
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="subjectsDropdown">
                            <li><a class="dropdown-item" href="#">Mathematics</a></li>
                            <li><a class="dropdown-item" href="#">Science</a></li>
                            <li><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">History</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tutorDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tutor
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="tutorDropdown">
                            <li><a class="dropdown-item" href="#">Find a Tutor</a></li>
                            <li><a class="dropdown-item" href="teacher-profile-wizard.php">Become a Tutor</a></li>
                            <li><a class="dropdown-item" href="request-tutor.php">Request a Tutor</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Login Button -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        
                        <?php if (Yii::$app->user->isGuest): ?>
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>" class="btn btn-primary w-100">Sign In</a>
                <?php else: ?>
                    <?php
                        echo Html::beginForm(['/logout'], 'post');
                        echo Html::submitButton(
                            'Logout',
                            ['class' => 'btn btn-primary w-100 logout']
                        );
                        echo Html::endForm();
                        ?>
                <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<style>
    @media (max-width: 991px) {
        #navbarMain {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    }
</style>