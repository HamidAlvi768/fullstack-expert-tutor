<?php
use yii\bootstrap5\Html;

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/style.css');
echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/login-modal.css');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/main.js');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/login-modal.js');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Tutor Expert</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Dancing+Script:wght@600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/profile.css"> -->
</head>

<!-- Include Top Header -->
<?php include 'includes/components/top-header.php'; ?>

<!-- Include Main Navigation -->
<?php include 'includes/components/main-nav.php'; ?>



    <?= $content ?>
    
    <!-- Footer Section -->
    <?php include 'includes/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom JavaScript -->
    <!-- <script src="assets/js/profile.js"></script>
    <script src="assets/js/profile-nav.js"></script> -->
</body>

</html>