<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\components\Helper;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/style.css');
echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/login-modal.css');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/main.js');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/login-modal.js');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/tutors.css">
</head>

<body class="tutors-page-wrapper">
    <?php $this->beginBody() ?>

    <body class="tutors-page-wrapper">
        <!-- Set custom logo for header -->
        <?php
        $custom_logo = 'assets/images/profile-logo.png';
        $custom_logo_alt = 'Tutor Expert';
        include 'includes/header.php';
        ?>



        <?= $content ?>



        <!-- Auth Modals -->

        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom JavaScript -->
        <script src="assets/js/tutors.js"></script>

        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>