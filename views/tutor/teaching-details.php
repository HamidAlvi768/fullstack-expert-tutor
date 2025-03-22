<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Teacher Teaching Details';
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
            <div class="teacher-teaching-details-form">
                <?php $form = ActiveForm::begin(['options' => ['class' => 'profile-form-container']]); ?>

                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'charge_type')->dropDownList([
                            'Hourly' => 'Hourly',
                            'Weekly' => 'Weekly',
                            'Monthly' => 'Monthly',
                        ], ['prompt' => 'Select Charge Type', 'class' => 'form-control profile-form-control'])->label('Charge Type') ?>
                    </div>

                    <div class="col-md-4">
                        <?= $form->field($model, 'minimum_fee')->textInput(['type' => 'number', 'required' => true, 'class' => 'form-control profile-form-control'])->label('Minimum Fee') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'maximum_fee')->textInput(['type' => 'number', 'class' => 'form-control profile-form-control'])->label('Maximum Fee') ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'fee_details')->textarea(['maxlength' => 255, 'class' => 'form-control profile-form-control'])->label('Fee Details') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'total_experience')->textInput(['type' => 'number', 'class' => 'form-control profile-form-control'])->label('Total Experience (Years)') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'teaching_experience')->textInput(['type' => 'number', 'class' => 'form-control profile-form-control'])->label('Teaching Experience (Years)') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'online_teaching_experience')->textInput(['type' => 'number', 'class' => 'form-control profile-form-control'])->label('Online Teaching Experience (Years)') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'travel_to_student')->radioList([1 => 'Yes', 0 => 'No'], ['class' => 'form-control profile-form-control'])->label('Travel to Student?') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'available_for_online')->radioList([1 => 'Yes', 0 => 'No'], ['class' => 'form-control profile-form-control'])->label('Available for Online?') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'digital_pen')->radioList([1 => 'Yes', 0 => 'No'], ['class' => 'form-control profile-form-control'])->label('Digital Pen?') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'help_work_assignments')->radioList([1 => 'Yes', 0 => 'No'], ['class' => 'form-control profile-form-control'])->label('Help with Work Assignments?') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'working_at_school')->radioList([1 => 'Yes', 0 => 'No'], ['class' => 'form-control profile-form-control'])->label('Working at School?') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'opportunity_interested')->dropDownList([
                            'Tutoring' => 'Tutoring',
                            'Mentorship' => 'Mentorship',
                            'Research Assistance' => 'Research Assistance',
                            'Online Classes' => 'Online Classes',
                        ], ['prompt' => 'Select Opportunity', 'class' => 'form-control profile-form-control'])->label('Opportunities Interested In') ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'communication_language')->dropDownList([
                            'English' => 'English',
                            'Urdu' => 'Urdu',
                            'French' => 'French',
                            'Spanish' => 'Spanish',
                            'Chinese' => 'Chinese',
                            'Japanese' => 'Japanese',
                            'Korean' => 'Korean',
                            'Hindi' => 'Hindi',
                            'Bengali' => 'Bengali',
                            'Arabic' => 'Arabic',
                            'Punjabi' => 'Punjabi',
                            'Sindhi' => 'Sindhi',
                            'Pashto' => 'Pashto',
                            'Balochi' => 'Balochi',
                            'Saraiki' => 'Saraiki',
                        ], ['prompt' => 'Select Communication Language', 'class' => 'form-control profile-form-control'])->label('Communication Language(s)') ?>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success profile-btn-save']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</body>