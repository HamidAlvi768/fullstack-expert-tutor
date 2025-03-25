<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Teacher Education';
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

.education-form-container {
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

.wizard-form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 20px;
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

.btn-add-education {
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

.btn-add-education:hover {
    background: #4F46E5;
    transform: translateY(-1px);
}

.btn-remove-education {
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

.btn-remove-education:hover {
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

#additional-education-entries {
    margin-top: 15px;
}

.form-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 15px;
}

.date-picker {
    position: relative;
}

.education-form-container {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.education-entry {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.additional-entry {
    border-top: 1px solid #e9ecef;
    padding-top: 25px;
    margin-top: 10px;
    position: relative;
}

.form-row {
    display: flex;
    gap: 20px;
}

.full-width {
    width: 100%;
}

.half-width {
    flex: 1;
}

.custom-select-wrapper {
    position: relative;
}

.dropdown-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    pointer-events: none;
}

.optional-label {
    color: #6c757d;
    font-weight: normal;
    font-size: 14px;
    margin-left: 5px;
}

.btn-remove-education {
    background-color: #f8f9fa;
    color: #dc3545;
    border: 1px solid #dc3545;
    border-radius: 8px;
    padding: 8px 15px;
    font-weight: 500;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    align-self: flex-start;
    margin-top: 10px;
}

.btn-remove-education:hover {
    background-color: #feecef;
}



</style>

<div class="profile-page">
    <div class="parent-container">
        <?php echo $this->render('_sidebar'); ?>
        
        
        <div class="education-form-container wizard-content">
    <h2 class="wizard-section-title">Education / Experience</h2>
    <!-- Education entries container -->
    <div id="education-entries">
        <!-- First education entry (default) -->
        <div class="education-entry">
            <!-- Institute Name with City -->
            <div class="wizard-form-group full-width">
                <label class="subject-label">Institute Name with City</label>
                <div class="custom-select-wrapper">
                    <input type="text" class="wizard-form-control" id="institute-name" name="institute_name" placeholder="Enter Name" value="<?php echo isset($_SESSION['wizard_data']['education-experience']['institute_name']) ? $_SESSION['wizard_data']['education-experience']['institute_name'] : ''; ?>">
                    <div class="dropdown-icon"><i class="fas fa-chevron-down"></i></div>
                </div>
            </div>
            
            <!-- Degree Type and Name (side by side) -->
            <div class="form-row">
                <div class="wizard-form-group half-width">
                    <label class="subject-label">Degree Type</label>
                    <select class="wizard-form-control wizard-select-control" id="degree-type" name="degree_type">
                        <option value="" selected disabled>-Degree Type-</option>
                        <option value="bachelors" <?php echo (isset($_SESSION['wizard_data']['education-experience']['degree_type']) && $_SESSION['wizard_data']['education-experience']['degree_type'] == 'bachelors') ? 'selected' : ''; ?>>Bachelor's</option>
                        <option value="masters" <?php echo (isset($_SESSION['wizard_data']['education-experience']['degree_type']) && $_SESSION['wizard_data']['education-experience']['degree_type'] == 'masters') ? 'selected' : ''; ?>>Master's</option>
                        <option value="phd" <?php echo (isset($_SESSION['wizard_data']['education-experience']['degree_type']) && $_SESSION['wizard_data']['education-experience']['degree_type'] == 'phd') ? 'selected' : ''; ?>>PhD</option>
                        <option value="diploma" <?php echo (isset($_SESSION['wizard_data']['education-experience']['degree_type']) && $_SESSION['wizard_data']['education-experience']['degree_type'] == 'diploma') ? 'selected' : ''; ?>>Diploma</option>
                        <option value="certificate" <?php echo (isset($_SESSION['wizard_data']['education-experience']['degree_type']) && $_SESSION['wizard_data']['education-experience']['degree_type'] == 'certificate') ? 'selected' : ''; ?>>Certificate</option>
                    </select>
                </div>
                
                <div class="wizard-form-group half-width">
                    <label class="subject-label">Degree Name</label>
                    <select class="wizard-form-control wizard-select-control" id="degree-name" name="degree_name">
                        <option value="" selected disabled>-Name-</option>
                        <option value="computer_science" <?php echo (isset($_SESSION['wizard_data']['education-experience']['degree_name']) && $_SESSION['wizard_data']['education-experience']['degree_name'] == 'computer_science') ? 'selected' : ''; ?>>Computer Science</option>
                        <option value="business" <?php echo (isset($_SESSION['wizard_data']['education-experience']['degree_name']) && $_SESSION['wizard_data']['education-experience']['degree_name'] == 'business') ? 'selected' : ''; ?>>Business Administration</option>
                        <option value="engineering" <?php echo (isset($_SESSION['wizard_data']['education-experience']['degree_name']) && $_SESSION['wizard_data']['education-experience']['degree_name'] == 'engineering') ? 'selected' : ''; ?>>Engineering</option>
                        <option value="education" <?php echo (isset($_SESSION['wizard_data']['education-experience']['degree_name']) && $_SESSION['wizard_data']['education-experience']['degree_name'] == 'education') ? 'selected' : ''; ?>>Education</option>
                        <option value="arts" <?php echo (isset($_SESSION['wizard_data']['education-experience']['degree_name']) && $_SESSION['wizard_data']['education-experience']['degree_name'] == 'arts') ? 'selected' : ''; ?>>Arts</option>
                    </select>
                </div>
            </div>
            
            <!-- Start Date and End Date (side by side) -->
            <div class="form-row">
                <div class="wizard-form-group half-width">
                    <label class="subject-label">Start Date</label>
                    <div class="custom-select-wrapper">
                        <input type="text" class="wizard-form-control date-picker" id="start-date" name="start_date" placeholder="MM/YY/DD" value="<?php echo isset($_SESSION['wizard_data']['education-experience']['start_date']) ? $_SESSION['wizard_data']['education-experience']['start_date'] : ''; ?>">
                        <div class="dropdown-icon"><i class="fas fa-chevron-down"></i></div>
                    </div>
                </div>
                
                <div class="wizard-form-group half-width">
                    <label class="subject-label">End Date</label>
                    <div class="custom-select-wrapper">
                        <input type="text" class="wizard-form-control date-picker" id="end-date" name="end_date" placeholder="MM/YY/DD" value="<?php echo isset($_SESSION['wizard_data']['education-experience']['end_date']) ? $_SESSION['wizard_data']['education-experience']['end_date'] : ''; ?>">
                        <div class="dropdown-icon"><i class="fas fa-chevron-down"></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Association -->
            <div class="wizard-form-group full-width">
                <label class="subject-label">Association</label>
                <select class="wizard-form-control wizard-select-control" id="association" name="association">
                    <option value="" selected disabled>Select</option>
                    <option value="student" <?php echo (isset($_SESSION['wizard_data']['education-experience']['association']) && $_SESSION['wizard_data']['education-experience']['association'] == 'student') ? 'selected' : ''; ?>>Student</option>
                    <option value="alumni" <?php echo (isset($_SESSION['wizard_data']['education-experience']['association']) && $_SESSION['wizard_data']['education-experience']['association'] == 'alumni') ? 'selected' : ''; ?>>Alumni</option>
                    <option value="faculty" <?php echo (isset($_SESSION['wizard_data']['education-experience']['association']) && $_SESSION['wizard_data']['education-experience']['association'] == 'faculty') ? 'selected' : ''; ?>>Faculty</option>
                    <option value="staff" <?php echo (isset($_SESSION['wizard_data']['education-experience']['association']) && $_SESSION['wizard_data']['education-experience']['association'] == 'staff') ? 'selected' : ''; ?>>Staff</option>
                </select>
            </div>
            
            <!-- Specialization (optional) -->
            <div class="wizard-form-group full-width">
                <label class="subject-label">Specialization<span class="optional-label">(optional)</span></label>
                <select class="wizard-form-control wizard-select-control" id="specialization" name="specialization">
                    <option value="" selected disabled>Select</option>
                    <option value="ai" <?php echo (isset($_SESSION['wizard_data']['education-experience']['specialization']) && $_SESSION['wizard_data']['education-experience']['specialization'] == 'ai') ? 'selected' : ''; ?>>Artificial Intelligence</option>
                    <option value="data_science" <?php echo (isset($_SESSION['wizard_data']['education-experience']['specialization']) && $_SESSION['wizard_data']['education-experience']['specialization'] == 'data_science') ? 'selected' : ''; ?>>Data Science</option>
                    <option value="software_dev" <?php echo (isset($_SESSION['wizard_data']['education-experience']['specialization']) && $_SESSION['wizard_data']['education-experience']['specialization'] == 'software_dev') ? 'selected' : ''; ?>>Software Development</option>
                    <option value="finance" <?php echo (isset($_SESSION['wizard_data']['education-experience']['specialization']) && $_SESSION['wizard_data']['education-experience']['specialization'] == 'finance') ? 'selected' : ''; ?>>Finance</option>
                    <option value="marketing" <?php echo (isset($_SESSION['wizard_data']['education-experience']['specialization']) && $_SESSION['wizard_data']['education-experience']['specialization'] == 'marketing') ? 'selected' : ''; ?>>Marketing</option>
                </select>
            </div>
        </div>
    </div>
    
    <!-- Container for additional education entries -->
    <div id="additional-education-entries">
        <?php
        if (isset($_SESSION['wizard_data']['education-experience']['additional_education']) && is_array($_SESSION['wizard_data']['education-experience']['additional_education'])) {
            foreach ($_SESSION['wizard_data']['education-experience']['additional_education'] as $index => $education) {
                ?>
                <div class="education-entry additional-entry" data-index="<?php echo $index + 1; ?>">
                    <!-- Institute Name with City -->
                    <div class="wizard-form-group full-width">
                        <label class="subject-label">Institute Name with City</label>
                        <div class="custom-select-wrapper">
                            <input type="text" class="wizard-form-control" name="additional_institute_name_<?php echo $index + 1; ?>" placeholder="Enter Name" value="<?php echo $education['institute_name']; ?>">
                            <div class="dropdown-icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                    </div>
                    
                    <!-- Degree Type and Name (side by side) -->
                    <div class="form-row">
                        <div class="wizard-form-group half-width">
                            <label class="subject-label">Degree Type</label>
                            <select class="wizard-form-control wizard-select-control" name="additional_degree_type_<?php echo $index + 1; ?>">
                                <option value="" disabled>-Degree Type-</option>
                                <option value="bachelors" <?php echo ($education['degree_type'] == 'bachelors') ? 'selected' : ''; ?>>Bachelor's</option>
                                <option value="masters" <?php echo ($education['degree_type'] == 'masters') ? 'selected' : ''; ?>>Master's</option>
                                <option value="phd" <?php echo ($education['degree_type'] == 'phd') ? 'selected' : ''; ?>>PhD</option>
                                <option value="diploma" <?php echo ($education['degree_type'] == 'diploma') ? 'selected' : ''; ?>>Diploma</option>
                                <option value="certificate" <?php echo ($education['degree_type'] == 'certificate') ? 'selected' : ''; ?>>Certificate</option>
                            </select>
                        </div>
                        
                        <div class="wizard-form-group half-width">
                            <label class="subject-label">Degree Name</label>
                            <select class="wizard-form-control wizard-select-control" name="additional_degree_name_<?php echo $index + 1; ?>">
                                <option value="" disabled>-Name-</option>
                                <option value="computer_science" <?php echo ($education['degree_name'] == 'computer_science') ? 'selected' : ''; ?>>Computer Science</option>
                                <option value="business" <?php echo ($education['degree_name'] == 'business') ? 'selected' : ''; ?>>Business Administration</option>
                                <option value="engineering" <?php echo ($education['degree_name'] == 'engineering') ? 'selected' : ''; ?>>Engineering</option>
                                <option value="education" <?php echo ($education['degree_name'] == 'education') ? 'selected' : ''; ?>>Education</option>
                                <option value="arts" <?php echo ($education['degree_name'] == 'arts') ? 'selected' : ''; ?>>Arts</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Start Date and End Date (side by side) -->
                    <div class="form-row">
                        <div class="wizard-form-group half-width">
                            <label class="subject-label">Start Date</label>
                            <div class="custom-select-wrapper">
                                <input type="text" class="wizard-form-control date-picker" name="additional_start_date_<?php echo $index + 1; ?>" placeholder="MM/YY/DD" value="<?php echo $education['start_date']; ?>">
                                <div class="dropdown-icon"><i class="fas fa-chevron-down"></i></div>
                            </div>
                        </div>
                        
                        <div class="wizard-form-group half-width">
                            <label class="subject-label">End Date</label>
                            <div class="custom-select-wrapper">
                                <input type="text" class="wizard-form-control date-picker" name="additional_end_date_<?php echo $index + 1; ?>" placeholder="MM/YY/DD" value="<?php echo $education['end_date']; ?>">
                                <div class="dropdown-icon"><i class="fas fa-chevron-down"></i></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Association -->
                    <div class="wizard-form-group full-width">
                        <label class="subject-label">Association</label>
                        <select class="wizard-form-control wizard-select-control" name="additional_association_<?php echo $index + 1; ?>">
                            <option value="" disabled>Select</option>
                            <option value="student" <?php echo ($education['association'] == 'student') ? 'selected' : ''; ?>>Student</option>
                            <option value="alumni" <?php echo ($education['association'] == 'alumni') ? 'selected' : ''; ?>>Alumni</option>
                            <option value="faculty" <?php echo ($education['association'] == 'faculty') ? 'selected' : ''; ?>>Faculty</option>
                            <option value="staff" <?php echo ($education['association'] == 'staff') ? 'selected' : ''; ?>>Staff</option>
                        </select>
                    </div>
                    
                    <!-- Specialization (optional) -->
                    <div class="wizard-form-group full-width">
                        <label class="subject-label">Specialization<span class="optional-label">(optional)</span></label>
                        <select class="wizard-form-control wizard-select-control" name="additional_specialization_<?php echo $index + 1; ?>">
                            <option value="" disabled>Select</option>
                            <option value="ai" <?php echo ($education['specialization'] == 'ai') ? 'selected' : ''; ?>>Artificial Intelligence</option>
                            <option value="data_science" <?php echo ($education['specialization'] == 'data_science') ? 'selected' : ''; ?>>Data Science</option>
                            <option value="software_dev" <?php echo ($education['specialization'] == 'software_dev') ? 'selected' : ''; ?>>Software Development</option>
                            <option value="finance" <?php echo ($education['specialization'] == 'finance') ? 'selected' : ''; ?>>Finance</option>
                            <option value="marketing" <?php echo ($education['specialization'] == 'marketing') ? 'selected' : ''; ?>>Marketing</option>
                        </select>
                    </div>
                    
                    <button type="button" class="btn-remove-education">
                        <i class="fas fa-times"></i> Remove
                    </button>
                </div>
                <?php
            }
        }
        ?>
    </div>
    
    <!-- Add Further Subject Button -->
    <button type="button" class="btn-add-subject" id="add-education">
        <span>Add Further Subject</span>
        <i class="fas fa-plus"></i>
    </button>
    <div class="wizard-form-actions">
        <button type="button" class="btn-save" id="save-education">Save</button>
        <button type="button" class="btn-next" id="next-step" data-next-step="professional-experience">Next</button>
    </div>
</div>

<!-- Form Actions -->
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

    // Add new education row
    $('#add-education').on('click', function() {
        const educationCount = $('#education-container .education-entry').length + $('#additional-education-entries .education-entry').length;
        
        // Clone the first education row
        const newRow = $('#education-container .education-entry:first').clone();
        
        // Reset values and update classes/IDs
        newRow.addClass('additional-entry');
        newRow.attr('data-index', educationCount);
        newRow.find('input, select, textarea').val('');
        
        // Update all input names and IDs
        newRow.find('select, input, textarea').each(function() {
            const name = $(this).attr('name');
            if (name) {
                $(this).attr('name', name.replace(/\[\d*\]/, '[' + educationCount + ']'));
            }
        });
        
        // Append to the additional education entries container
        $('#additional-education-entries').append(newRow);
        
        // Re-initialize date pickers for new fields
        initializeDatePickers();
    });

    // Remove education row
    $(document).on('click', '.btn-remove-education', function() {
        const row = $(this).closest('.education-entry');
        const totalRows = $('#education-container .education-entry').length + $('#additional-education-entries .education-entry').length;
        
        // Check if there is more than one row
        if (totalRows > 1) {
            row.fadeOut(300, function() {
                $(this).remove();
            });
        } else {
            alert('At least one education entry must remain.');
        }
    });
JS;
$this->registerJs($js);
?>