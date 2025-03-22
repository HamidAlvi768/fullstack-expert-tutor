<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Teacher Subjects';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/profile.css');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile.js');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile-nav.js');
?>

<body class="profile-page">
    <div class="profile-main-content">
        <div class="container">
            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

            <div class="profiles-form mt-4">
                <?php $form = ActiveForm::begin(['options' => ['class' => 'profile-form-container']]); ?>

                <div id="subject-container">
                    <div class="subject-row mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($model, 'subject[]')->dropDownList([
                                    'english' => 'English',
                                    'mathematics' => 'Mathematics',
                                    'science' => 'Science',
                                    'history' => 'History',
                                    'geography' => 'Geography',
                                    'physics' => 'Physics',
                                    'chemistry' => 'Chemistry',
                                    'biology' => 'Biology',
                                    'computer_science' => 'Computer Science',
                                    'economics' => 'Economics',
                                    'business_studies' => 'Business Studies',
                                    'art' => 'Art',
                                    'music' => 'Music',
                                    'physical_education' => 'Physical Education'
                                ], [
                                    'class' => 'form-control profile-form-control',
                                    'required' => true
                                ]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'from_level[]')->dropDownList([
                                    'beginner' => 'Beginner',
                                    'elementary' => 'Elementary',
                                    'intermediate' => 'Intermediate',
                                    'upper_intermediate' => 'Upper Intermediate',
                                    'advanced' => 'Advanced',
                                    'proficient' => 'Proficient'
                                ], [
                                    'class' => 'form-control profile-form-control',
                                    'required' => true,
                                    'prompt' => '-Select lowest level-'
                                ]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'to_level[]')->dropDownList([
                                    'beginner' => 'Beginner',
                                    'elementary' => 'Elementary',
                                    'intermediate' => 'Intermediate',
                                    'upper_intermediate' => 'Upper Intermediate',
                                    'advanced' => 'Advanced',
                                    'proficient' => 'Proficient'
                                ], [
                                    'class' => 'form-control profile-form-control',
                                    'required' => true,
                                    'prompt' => '-Select highest level-'
                                ]) ?>
                            </div>
                        </div>
                        <button type="button" class="remove-subject btn btn-danger mt-2" style="width: 100%;">Remove Subject</button>
                    </div>
                </div>

                <div class="form-group mt-4 text-center">
                    <button type="button" id="add-subject" class="btn btn-primary">Add Subject</button>
                </div>

                <div class="form-group text-center mt-4">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success profile-btn-save']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</body>

<?php
$js = <<<JS
    // Add new subject row
    $('#add-subject').on('click', function() {
        var newRow = $('#subject-container .subject-row:first').clone();
        newRow.find('input, select').val(''); // Reset values
        $('#subject-container').append(newRow);
    });

    // Remove subject row
    $(document).on('click', '.remove-subject', function() {
        // Check if there is more than one row
        if ($('#subject-container .subject-row').length > 1) {
            $(this).closest('.subject-row').remove();
        } else {
            alert('At least one subject must remain.');
        }
    });
JS;
$this->registerJs($js);
?>

<?php
// Optionally, you can add custom CSS for the layout or enhance the design
$this->registerCss(
    <<<CSS
    .profiles-create {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .profiles-form .subject-row {
        padding: 15px;
        border-radius: 8px;
        background-color: #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .profiles-form .subject-row .form-group {
        margin-bottom: 15px;
    }

    .remove-subject {
        background-color: #e74c3c;
        border-color: #e74c3c;
        color: #fff;
        font-size: 14px;
    }

    .remove-subject:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }

    .form-control {
        border-radius: 8px;
    }

    .btn {
        font-size: 16px;
        border-radius: 8px;
    }

    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }

    .btn-success {
        background-color: #2ecc71;
        border-color: #2ecc71;
    }

    .btn-success:hover {
        background-color: #27ae60;
        border-color: #27ae60;
    }

    .btn-lg {
        padding: 10px 20px;
        font-size: 18px;
    }

    .text-center {
        text-align: center;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .mt-2 {
        margin-top: 1rem;
    }

    .mt-4 {
        margin-top: 2rem;
    }
CSS
);
?>
