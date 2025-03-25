<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Teacher Job Description';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/profile.css');
echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/wizard-common.css');
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
</style>

<div class="profile-page">
    <div class="parent-container">
        <?php echo $this->render('_sidebar'); ?>
        
        
        <div class="description-form-container wizard-content">
    <h2 class="wizard-section-title">Description</h2>
    <!-- Description textarea with custom styling -->
    <div class="wizard-form-group full-width">
        <label class="subject-label">Your Role and responsibility at this job</label>
        <textarea class="wizard-form-control" id="teacher-description" name="teacher_description" rows="8" placeholder="Describe"><?php echo isset($_SESSION['wizard_data']['description']['teacher_description']) ? $_SESSION['wizard_data']['description']['teacher_description'] : ''; ?></textarea>
    </div>
    
    <!-- Privacy checkbox -->
    <div class="wizard-form-group full-width" >
        <div class="checkbox-option">
            <input type="checkbox" id="privacy-agreement" name="privacy_agreement" <?php echo (isset($_SESSION['wizard_data']['description']['privacy_agreement']) && $_SESSION['wizard_data']['description']['privacy_agreement']) ? 'checked' : ''; ?>>
            <label for="privacy-agreement">I have not share of any details like(Phone, Skype,whatsapp etc.)</label>
        </div>
    </div>
    <!-- Form Actions -->
    <div class="wizard-form-actions">
        <button type="button" class="btn-save" id="save-description">Save</button>
        <button type="button" class="btn-next" id="finish-wizard">Next</button>
    </div>
</div>

    </div>
</div>