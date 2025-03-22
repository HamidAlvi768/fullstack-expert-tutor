<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Teacher Education';
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
            <div class="teacher-education-form">
                <?php $form = ActiveForm::begin(['options' => ['class' => 'profile-form-container']]); ?>

                <div id="education-container">
                    <div class="education-row mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'institute_name[]')->textInput(['maxlength' => 255, 'required' => true, 'class' => 'form-control profile-form-control'])->label('Institute Name') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'degree_type[]')->textInput(['maxlength' => 100, 'required' => true, 'class' => 'form-control profile-form-control'])->label('Degree Type') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'degree_name[]')->textInput(['maxlength' => 100, 'required' => true, 'class' => 'form-control profile-form-control'])->label('Degree Name') ?>
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
                            <div class="col-md-6">
                                <?= $form->field($model, 'specialization[]')->textInput(['maxlength' => 255, 'class' => 'form-control profile-form-control'])->label('Specialization') ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="button" class="remove-education btn btn-danger">Remove</button>
                                <button type="button" id="add-education" class="btn btn-primary">Add Education</button>
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
    // Add new education row
    $('#add-education').on('click', function() {
        var newRow = $('#education-container .education-row:first').clone();
        newRow.find('input').val(''); // Reset values
        $('#education-container').append(newRow);
    });

    // Remove education row
    $(document).on('click', '.remove-education', function() {
        // Check if there is more than one row
        if ($('#education-container .education-row').length > 1) {
            $(this).closest('.education-row').remove();
        } else {
            alert('At least one education must remain.');
        }
    });
JS;
$this->registerJs($js);
?>