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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login-modal.css"> -->
</head>

<body class="">
    <?php $this->beginBody() ?>

    <div class="hero-wrapper">
        <?= $this->render('_header') ?>

        <?= $content ?>


        <?= $this->render('_footer') ?>
        <!-- Auth Modals -->

    </div>

    <!-- Bootstrap JS and other scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="assets/js/main.js"></script>
    <script src="assets/js/login-modal.js"></script> -->
    <script src="<?php echo Helper::baseUrl("/assets/js/enc.js") ?>"></script>

    <script>
        var oldTitle = document.title;

        function sendLogTime(data) {
            if (typeof fetch === 'function') {
                // Use Fetch API with keepalive to send data during unload
                fetch('/log-user-leaving', {
                    method: 'POST',
                    body: data,
                    keepalive: true,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
            } else {
                // Fallback for browsers without fetch support
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/log-user-leaving', false); // Synchronous request
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(data);
            }
        }
        document.addEventListener("visibilitychange", () => {
            if (document.hidden) {
                document.title = "Closed";
                // Prepare the data to send
                const data = JSON.stringify({
                    message: 'User left the page',
                    timestamp: Date.now()
                });
                sendLogTime(data);

            } else {
                document.title = "Opened";
            }
        })
        // window.addEventListener('beforeunload', function(event) {
        //     event.returnValue = 'Are you sure you want to leave?'; // Triggers dialog
        // });

        window.addEventListener('unload', function(event) {
            // Prepare the data to send
            const data = JSON.stringify({
                message: 'User left the page',
                timestamp: Date.now()
            });
            sendLogTime(data);
        });
    </script>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>