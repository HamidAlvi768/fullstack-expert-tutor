<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Teacher Professional Experience';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/profile.css');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile.js');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile-nav.js');
?>

<body class="profile-page">
    <div class="profile-main-content">
        <div class="container">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="teacher-experience-form">
                <?php $form = ActiveForm::begin(['options' => ['class' => 'profile-form-container']]); ?>

                <div id="experience-container">
                    <div class="experience-row mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'organization[]')->textInput(['maxlength' => 255, 'required' => true, 'class' => 'form-control profile-form-control'])->label('Organization') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'designation[]')->textInput(['maxlength' => 100, 'required' => true, 'class' => 'form-control profile-form-control'])->label('Designation') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'start_date[]')->input('date', ['required' => true, 'class' => 'form-control profile-form-control'])->label('Start Date') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'end_date[]')->input('date', ['class' => 'form-control profile-form-control'])->label('End Date') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'association[]')->textInput(['maxlength' => 255, 'class' => 'form-control profile-form-control'])->label('Association') ?>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($model, 'job_role[]')->textarea(['maxlength' => 255, 'class' => 'form-control profile-form-control'])->label('Job Role') ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="button" class="remove-experience btn btn-danger">Remove</button>
                                <button type="button" id="add-experience" class="btn btn-primary">Add Experience</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success profile-btn-save']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</body>

<?php
$js = <<<JS
    // Add new experience row
    $('#add-experience').on('click', function() {
        var newRow = $('#experience-container .experience-row:first').clone();
        newRow.find('input, textarea').val(''); // Reset values
        $('#experience-container').append(newRow);
    });

    // Remove experience row
    $(document).on('click', '.remove-experience', function() {
        // Check if there is more than one row
        if ($('#experience-container .experience-row').length > 1) {
            $(this).closest('.experience-row').remove();
        } else {
            alert('At least one experience must remain.');
        }
    });
JS;
$this->registerJs($js);
?>