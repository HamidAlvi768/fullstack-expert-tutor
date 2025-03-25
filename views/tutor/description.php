<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Teacher Description';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/profile.css');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile.js');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile-nav.js');
?>

<style>
.parent-container {
    display: flex;
    gap: 20px;
    max-width: 1320px;
    margin: 0 auto;
}

.profile-content {
    flex: 1;
}

.profile-page::before {
    background: #f8f9fa;
}

.wizard-section-title {
    font-size: 24px;
    margin-bottom: 30px;
    color: #333;
    font-weight: 500;
}

.description-form-container {
    padding: 30px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.wizard-form-group {
    margin-bottom: 24px;
}

.full-width {
    width: 100%;
}

.subject-label {
    display: block;
    margin-bottom: 10px;
    color: #495057;
    font-weight: 500;
    font-size: 15px;
}

.wizard-form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
}

.wizard-form-control:focus {
    border-color: #6366F1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    outline: none;
}

.profile-btn-save {
    background: #6366F1;
    color: white;
    border: none;
    padding: 14px 40px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.profile-btn-save:hover {
    background: #4F46E5;
    transform: translateY(-1px);
}

.wizard-form-actions {
    margin-top: 20px;
    text-align: center;
}

textarea.wizard-form-control {
    resize: vertical;
    min-height: 200px;
}

.checkbox-option {
    display: flex;
    align-items: center;
    margin: 20px 0;
    cursor: pointer;
}

.checkbox-option input[type="checkbox"] {
    appearance: none;
    -webkit-appearance: none;
    width: 20px;
    height: 20px;
    border: 2px solid #d1d5db;
    border-radius: 4px;
    margin-right: 10px;
    position: relative;
    cursor: pointer;
}

.checkbox-option input[type="checkbox"]:checked {
    background-color: #6366F1;
    border-color: #6366F1;
}

.checkbox-option input[type="checkbox"]:checked::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(45deg);
    width: 5px;
    height: 10px;
    border-right: 2px solid #fff;
    border-bottom: 2px solid #fff;
}

.checkbox-option label {
    font-size: 15px;
    color: #4b5563;
    cursor: pointer;
}
</style>

<div class="profile-page">
    <div class="parent-container">
        <?php echo $this->render('_sidebar'); ?>
        
        <div class="profile-content">
            <div class="container">
                <h2 class="wizard-section-title"><?= Html::encode($this->title) ?></h2>
                
                <div class="description-form-container">
                    <?php $form = ActiveForm::begin(['options' => ['class' => 'profile-form-container']]); ?>

                    <div class="wizard-form-group full-width">
                        <label class="subject-label">Your Role and Responsibilities</label>
                        <?= $form->field($model, 'description')->textarea([
                            'rows' => 8,
                            'class' => 'wizard-form-control',
                            'placeholder' => 'Describe your role and responsibilities in detail...'
                        ])->label(false) ?>
                    </div>

                    <div class="wizard-form-group">
                        <?= $form->field($model, 'privacy_agreement')->checkbox([
                            'template' => '<div class="checkbox-option">{input} {label}</div>',
                            'label' => 'I have not shared any contact details (Phone, Skype, WhatsApp etc.)'
                        ])->label(false) ?>
                    </div>

                    <div class="wizard-form-actions">
                        <?= Html::submitButton('Save', ['class' => 'profile-btn-save']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div> 