<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Teacher Teaching Details';
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

.teaching-form-container {
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

.wizard-select-control {
    height: 48px;
    background-position: right 16px center;
    appearance: none;
    -webkit-appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>');
    background-repeat: no-repeat;
    padding-right: 40px;
}

.custom-select-wrapper {
    position: relative;
    width: 100%;
}

.custom-select-wrapper .wizard-form-control {
    width: 100%;
}

.custom-select-wrapper .dropdown-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: #6b7280;
}

.radio-options {
    display: flex;
    gap: 30px;
    margin-top: 5px;
}

.radio-option {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.radio-option input[type="radio"] {
    appearance: none;
    -webkit-appearance: none;
    width: 20px;
    height: 20px;
    border: 2px solid #d1d5db;
    border-radius: 50%;
    outline: none;
    cursor: pointer;
    position: relative;
}

.radio-option input[type="radio"]:checked {
    border-color: #6366F1;
}

.radio-option input[type="radio"]:checked::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 10px;
    height: 10px;
    background-color: #6366F1;
    border-radius: 50%;
}

.radio-option label {
    font-size: 15px;
    color: #4b5563;
    cursor: pointer;
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

.form-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
}

textarea.wizard-form-control {
    resize: vertical;
    min-height: 120px;
}
</style>

<div class="profile-page">
    <div class="parent-container">
        <?php echo $this->render('_sidebar'); ?>
        
        
        <div class="teaching-form-container wizard-content">
    <h2 class="wizard-section-title">Teaching Details</h2>
    <!-- Fee Structure Section -->
    <div class="form-row">
        <div class="wizard-form-group" style="flex: 1;">
            <label class="subject-label">I Charge</label>
            <select class="wizard-form-control wizard-select-control" name="charge_type" id="charge-type">
                <option value="hourly" selected>Hourly</option>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
            </select>
        </div>
        
        <div class="wizard-form-group" style="flex: 1;">
            <label class="subject-label">Min Fee</label>
            <select class="wizard-form-control wizard-select-control" name="min_fee" id="min-fee">
                <option value="" selected disabled>Fee</option>
                <?php for($i = 10; $i <= 200; $i += 5): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        
        <div class="wizard-form-group" style="flex: 1;">
            <label class="subject-label">Max Fee</label>
            <select class="wizard-form-control wizard-select-control" name="max_fee" id="max-fee">
                <option value="" selected disabled>Fee</option>
                <?php for($i = 20; $i <= 300; $i += 5): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
    
    <!-- Fee Details -->
    <div class="wizard-form-group full-width">
        <label class="subject-label">Fee Details</label>
        <div class="custom-select-wrapper">
            <input type="text" class="wizard-form-control" name="fee_details" id="fee-details" placeholder="Detail">
            <div class="dropdown-icon"><i class="fas fa-chevron-down"></i></div>
        </div>
    </div>
    
    <!-- Experience Fields -->
    <div class="wizard-form-group full-width">
        <label class="subject-label">Total Experience</label>
        <select class="wizard-form-control wizard-select-control" name="total_experience" id="total-experience">
            <option value="" selected disabled>Year</option>
            <?php for($i = 1; $i <= 30; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i . ' ' . ($i == 1 ? 'Year' : 'Years'); ?></option>
            <?php endfor; ?>
        </select>
    </div>
    
    <div class="wizard-form-group full-width">
        <label class="subject-label">Teaching Experience</label>
        <select class="wizard-form-control wizard-select-control" name="teaching_experience" id="teaching-experience">
            <option value="" selected disabled>Year</option>
            <?php for($i = 1; $i <= 30; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i . ' ' . ($i == 1 ? 'Year' : 'Years'); ?></option>
            <?php endfor; ?>
        </select>
    </div>
    
    <div class="wizard-form-group full-width">
        <label class="subject-label">Online Teaching Experience</label>
        <select class="wizard-form-control wizard-select-control" name="online_teaching_experience" id="online-teaching-experience">
            <option value="" selected disabled>Year</option>
            <?php for($i = 1; $i <= 30; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i . ' ' . ($i == 1 ? 'Year' : 'Years'); ?></option>
            <?php endfor; ?>
        </select>
    </div>
    
    <!-- Yes/No Questions -->
    <div class="wizard-form-group full-width">
        <label class="subject-label">Are You Willing to travel to Student?</label>
        <div class="radio-options">
            <div class="radio-option">
                <input type="radio" id="travel-yes" name="willing_to_travel" value="yes">
                <label for="travel-yes">Yes</label>
            </div>
            <div class="radio-option">
                <input type="radio" id="travel-no" name="willing_to_travel" value="no">
                <label for="travel-no">No</label>
            </div>
        </div>
    </div>
    
    <div class="wizard-form-group full-width">
        <label class="subject-label">Available for online?</label>
        <div class="radio-options">
            <div class="radio-option">
                <input type="radio" id="online-yes" name="available_online" value="yes">
                <label for="online-yes">Yes</label>
            </div>
            <div class="radio-option">
                <input type="radio" id="online-no" name="available_online" value="no">
                <label for="online-no">No</label>
            </div>
        </div>
    </div>
    
    <div class="wizard-form-group full-width">
        <label class="subject-label">Do you have digital pen?</label>
        <div class="radio-options">
            <div class="radio-option">
                <input type="radio" id="digital-pen-yes" name="have_digital_pen" value="yes">
                <label for="digital-pen-yes">Yes</label>
            </div>
            <div class="radio-option">
                <input type="radio" id="digital-pen-no" name="have_digital_pen" value="no">
                <label for="digital-pen-no">No</label>
            </div>
        </div>
    </div>
    
    <div class="wizard-form-group full-width">
        <label class="subject-label">Do you help with homework or assignment?</label>
        <div class="radio-options">
            <div class="radio-option">
                <input type="radio" id="homework-yes" name="help_with_homework" value="yes">
                <label for="homework-yes">Yes</label>
            </div>
            <div class="radio-option">
                <input type="radio" id="homework-no" name="help_with_homework" value="no">
                <label for="homework-no">No</label>
            </div>
        </div>
    </div>
    
    <div class="wizard-form-group full-width">
        <label class="subject-label">Are you current working at any school at full time?</label>
        <div class="radio-options">
            <div class="radio-option">
                <input type="radio" id="school-yes" name="working_at_school" value="yes">
                <label for="school-yes">Yes</label>
            </div>
            <div class="radio-option">
                <input type="radio" id="school-no" name="working_at_school" value="no">
                <label for="school-no">No</label>
            </div>
        </div>
    </div>
    
    <!-- Additional Dropdowns -->
    <div class="wizard-form-group full-width">
        <label class="subject-label">Opportunity are you interested</label>
        <select class="wizard-form-control wizard-select-control" name="interested_opportunity" id="interested-opportunity">
            <option value="" selected disabled>Select</option>
            <option value="full_time">Full Time</option>
            <option value="part_time">Part Time</option>
            <option value="freelance">Freelance</option>
            <option value="contract">Contract</option>
            <option value="all">All Opportunities</option>
        </select>
    </div>
    
    <div class="wizard-form-group full-width">
        <label class="subject-label">Communication language</label>
        <select class="wizard-form-control wizard-select-control" name="communication_language" id="communication-language">
            <option value="" selected disabled>Select</option>
            <option value="english">English</option>
            <option value="spanish">Spanish</option>
            <option value="french">French</option>
            <option value="german">German</option>
            <option value="chinese">Chinese</option>
            <option value="arabic">Arabic</option>
            <option value="hindi">Hindi</option>
            <option value="other">Other</option>
        </select>
    </div>
    <!-- Form Actions -->
    <div class="wizard-form-actions">
        <button type="button" class="btn-save" id="save-teaching">Save</button>
        <button type="button" class="btn-next" id="next-step" data-next-step="description">Next</button>
    </div>
</div>

    </div>
</div>