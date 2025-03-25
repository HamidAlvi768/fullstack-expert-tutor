<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Teacher Professional Experience';
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

.professional-form-container {
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

.half-width {
    width: 48%;
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

.wizard-form-control.date-picker {
    background-position: right 16px center;
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

.btn-add-experience {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 14px;
    background: #6366F1;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    margin: 28px 0;
    transition: all 0.3s ease;
}

.btn-add-experience:hover {
    background: #4F46E5;
    transform: translateY(-1px);
}

.btn-remove-experience {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 14px;
    background: #ef4444;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    margin: 10px 0;
    transition: all 0.3s ease;
}

.btn-remove-experience:hover {
    background: #dc2626;
    transform: translateY(-1px);
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

.additional-entry {
    margin-top: 30px;
}

#additional-experience-entries {
    margin-top: 15px;
}

.form-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 15px;
}

textarea.wizard-form-control {
    resize: vertical;
    min-height: 120px;
}
</style>

<div class="profile-page">
    <div class="parent-container">
        <?php echo $this->render('_sidebar'); ?>
        
        
        <div class="professional-form-container wizard-content">
    <h2 class="wizard-section-title">Professional Experience</h2>
    <!-- Professional Experience entries container -->
    <div id="experience-entries">
        <!-- First experience entry (default) -->
        <div class="experience-entry">
            <!-- Organization With City -->
            <div class="wizard-form-group full-width">
                <label class="subject-label">Organization With City</label>
                <div class="custom-select-wrapper">
                    <input type="text" class="wizard-form-control" id="organization-name" name="organization_name" placeholder="Enter Name" value="<?php echo isset($_SESSION['wizard_data']['professional-experience']['organization_name']) ? $_SESSION['wizard_data']['professional-experience']['organization_name'] : ''; ?>">
                    <div class="dropdown-icon"><i class="fas fa-chevron-down"></i></div>
                </div>
            </div>
            
            <!-- Designation -->
            <div class="wizard-form-group full-width">
                <label class="subject-label">Designation</label>
                <div class="custom-select-wrapper">
                    <input type="text" class="wizard-form-control" id="designation" name="designation" placeholder="Enter Name" value="<?php echo isset($_SESSION['wizard_data']['professional-experience']['designation']) ? $_SESSION['wizard_data']['professional-experience']['designation'] : ''; ?>">
                    <div class="dropdown-icon"><i class="fas fa-chevron-down"></i></div>
                </div>
            </div>
            
            <!-- Start Date and End Date (side by side) -->
            <div class="form-row">
                <div class="wizard-form-group half-width">
                    <label class="subject-label">Start Date</label>
                    <div class="custom-select-wrapper">
                        <input type="text" class="wizard-form-control date-picker" id="start-date" name="start_date" placeholder="MM/YY/DD" value="<?php echo isset($_SESSION['wizard_data']['professional-experience']['start_date']) ? $_SESSION['wizard_data']['professional-experience']['start_date'] : ''; ?>">
                        <div class="dropdown-icon"><i class="fas fa-chevron-down"></i></div>
                    </div>
                </div>
                
                <div class="wizard-form-group half-width">
                    <label class="subject-label">End Date</label>
                    <div class="custom-select-wrapper">
                        <input type="text" class="wizard-form-control date-picker" id="end-date" name="end_date" placeholder="MM/YY/DD" value="<?php echo isset($_SESSION['wizard_data']['professional-experience']['end_date']) ? $_SESSION['wizard_data']['professional-experience']['end_date'] : ''; ?>">
                        <div class="dropdown-icon"><i class="fas fa-chevron-down"></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Association -->
            <div class="wizard-form-group full-width">
                <label class="subject-label">Association</label>
                <select class="wizard-form-control wizard-select-control" id="association" name="association">
                    <option value="" selected disabled>Select</option>
                    <option value="full_time" <?php echo (isset($_SESSION['wizard_data']['professional-experience']['association']) && $_SESSION['wizard_data']['professional-experience']['association'] == 'full_time') ? 'selected' : ''; ?>>Full Time</option>
                    <option value="part_time" <?php echo (isset($_SESSION['wizard_data']['professional-experience']['association']) && $_SESSION['wizard_data']['professional-experience']['association'] == 'part_time') ? 'selected' : ''; ?>>Part Time</option>
                    <option value="contract" <?php echo (isset($_SESSION['wizard_data']['professional-experience']['association']) && $_SESSION['wizard_data']['professional-experience']['association'] == 'contract') ? 'selected' : ''; ?>>Contract</option>
                    <option value="freelance" <?php echo (isset($_SESSION['wizard_data']['professional-experience']['association']) && $_SESSION['wizard_data']['professional-experience']['association'] == 'freelance') ? 'selected' : ''; ?>>Freelance</option>
                </select>
            </div>
            
            <!-- Role and Responsibility -->
            <div class="wizard-form-group full-width">
                <label class="subject-label">Your Role and responsibility at this job</label>
                <textarea class="wizard-form-control" id="role-responsibility" name="role_responsibility" placeholder="Describe" rows="4"><?php echo isset($_SESSION['wizard_data']['professional-experience']['role_responsibility']) ? $_SESSION['wizard_data']['professional-experience']['role_responsibility'] : ''; ?></textarea>
            </div>
        </div>
    </div>
    
    <!-- Container for additional experience entries -->
    <div id="additional-experience-entries">
        <?php
        if (isset($_SESSION['wizard_data']['professional-experience']['additional_experience']) && is_array($_SESSION['wizard_data']['professional-experience']['additional_experience'])) {
            foreach ($_SESSION['wizard_data']['professional-experience']['additional_experience'] as $index => $experience) {
                ?>
                <div class="experience-entry additional-entry" data-index="<?php echo $index + 1; ?>">
                    <!-- Additional experience fields here -->
                    <!-- Similar structure as above but with unique IDs and names -->
                    <button type="button" class="btn-remove-experience">
                        <i class="fas fa-times"></i> Remove
                    </button>
                </div>
                <?php
            }
        }
        ?>
    </div>
    
    <!-- Add Further Experience Button -->
    <button type="button" class="btn-add-experience" id="add-experience">
        <span>Add Further Experience</span>
        <i class="fas fa-plus"></i>
    </button>
    <!-- Form Actions -->
    <div class="wizard-form-actions">
        <button type="button" class="btn-save" id="save-experience">Save</button>
        <button type="button" class="btn-next" id="next-step" data-next-step="teaching-details">Next</button>
    </div>
</div>

    </div>
</div>

<?php
$js = <<<JS
    // Initialize date pickers
    function initializeDatePickers() {
        document.querySelectorAll('.date-picker').forEach(datePicker => {
            datePicker.addEventListener('focus', function() {
                this.type = 'date';
            });
            
            datePicker.addEventListener('blur', function() {
                if (this.value === '') {
                    this.type = 'text';
                }
            });
        });
    }
    
    // Call the initialization function
    initializeDatePickers();

    // Add new experience row
    $('#add-experience').on('click', function() {
        const experienceCount = $('#experience-container .experience-entry').length + $('#additional-experience-entries .experience-entry').length;
        
        // Clone the first experience row
        const newRow = $('#experience-container .experience-entry:first').clone();
        
        // Reset values and update classes/IDs
        newRow.addClass('additional-entry');
        newRow.attr('data-index', experienceCount);
        newRow.find('input, select, textarea').val('');
        
        // Update all input names and IDs
        newRow.find('select, input, textarea').each(function() {
            const name = $(this).attr('name');
            if (name) {
                $(this).attr('name', name.replace(/\[\d*\]/, '[' + experienceCount + ']'));
            }
        });
        
        // Append to the additional experience entries container
        $('#additional-experience-entries').append(newRow);
        
        // Re-initialize date pickers for new fields
        initializeDatePickers();
    });

    // Remove experience row
    $(document).on('click', '.btn-remove-experience', function() {
        const row = $(this).closest('.experience-entry');
        const totalRows = $('#experience-container .experience-entry').length + $('#additional-experience-entries .experience-entry').length;
        
        // Check if there is more than one row
        if (totalRows > 1) {
            row.fadeOut(300, function() {
                $(this).remove();
            });
        } else {
            alert('At least one experience entry must remain.');
        }
    });
JS;
$this->registerJs($js);
?>