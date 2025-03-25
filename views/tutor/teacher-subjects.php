<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Teacher Subjects';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/profile.css');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile.js');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile-nav.js');
echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/wizard-common.css');
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

    .wizard-section-title {
        font-size: 24px;
        margin-bottom: 30px;
        color: #333;
        font-weight: 500;
    }

    .subject-form-container {
        padding: 30px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .subject-form-group {
        margin-bottom: 24px;
    }

    .level-form-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 20px;
    }

    .level-form-group {
        margin-bottom: 0;
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

    .btn-add-subject {
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

    .btn-add-subject:hover {
        background: #4F46E5;
        transform: translateY(-1px);
    }

    .btn-remove-subject {
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

    .btn-remove-subject:hover {
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

    .form-group.text-center {
        margin-top: 20px;
    }

    .subject-row {
        background: #f8fafc;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        border: 1px solid #f1f5f9;
    }

    .subject-section {
        margin-top: 30px;
        background: #f8fafc;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        border: 1px solid #f1f5f9;
    }

    #additional-subjects-container {
        margin-top: 15px;
    }

    .wizard-form-actions {
        margin-top: 20px;
        text-align: center;
    }
</style>

<div class="profile-page">
    <div class="parent-container">
        <?php echo $this->render('_sidebar'); ?>

        <!-- Subject Fields -->
        <div class="subject-form-container wizard-content">

            <h2 class="wizard-section-title">Subject you Teach</h2>
            <div class="subject-form-group">
                <label for="subject" class="subject-label">Subject</label>
                <select class="wizard-form-control wizard-select-control subject-select" id="subject" name="subject">
                    <option value="" selected disabled>Set Language</option>
                    <option value="english" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'english') ? 'selected' : ''; ?>>English</option>
                    <option value="mathematics" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'mathematics') ? 'selected' : ''; ?>>Mathematics</option>
                    <option value="science" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'science') ? 'selected' : ''; ?>>Science</option>
                    <option value="history" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'history') ? 'selected' : ''; ?>>History</option>
                    <option value="geography" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'geography') ? 'selected' : ''; ?>>Geography</option>
                    <option value="physics" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'physics') ? 'selected' : ''; ?>>Physics</option>
                    <option value="chemistry" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'chemistry') ? 'selected' : ''; ?>>Chemistry</option>
                    <option value="biology" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'biology') ? 'selected' : ''; ?>>Biology</option>
                    <option value="computer_science" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'computer_science') ? 'selected' : ''; ?>>Computer Science</option>
                    <option value="economics" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'economics') ? 'selected' : ''; ?>>Economics</option>
                    <option value="business_studies" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'business_studies') ? 'selected' : ''; ?>>Business Studies</option>
                    <option value="art" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'art') ? 'selected' : ''; ?>>Art</option>
                    <option value="music" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'music') ? 'selected' : ''; ?>>Music</option>
                    <option value="physical_education" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['subject']) && $_SESSION['wizard_data']['subject-teach']['subject'] == 'physical_education') ? 'selected' : ''; ?>>Physical Education</option>
                </select>
            </div>

            <div class="level-form-container">
                <div class="level-form-group">
                    <label for="from-level" class="subject-label">From level</label>
                    <select class="wizard-form-control wizard-select-control level-select" id="from-level" name="from_level">
                        <option value="" selected disabled>-Select lowest level-</option>
                        <option value="beginner" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['from_level']) && $_SESSION['wizard_data']['subject-teach']['from_level'] == 'beginner') ? 'selected' : ''; ?>>Beginner</option>
                        <option value="elementary" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['from_level']) && $_SESSION['wizard_data']['subject-teach']['from_level'] == 'elementary') ? 'selected' : ''; ?>>Elementary</option>
                        <option value="intermediate" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['from_level']) && $_SESSION['wizard_data']['subject-teach']['from_level'] == 'intermediate') ? 'selected' : ''; ?>>Intermediate</option>
                        <option value="upper_intermediate" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['from_level']) && $_SESSION['wizard_data']['subject-teach']['from_level'] == 'upper_intermediate') ? 'selected' : ''; ?>>Upper Intermediate</option>
                        <option value="advanced" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['from_level']) && $_SESSION['wizard_data']['subject-teach']['from_level'] == 'advanced') ? 'selected' : ''; ?>>Advanced</option>
                        <option value="proficient" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['from_level']) && $_SESSION['wizard_data']['subject-teach']['from_level'] == 'proficient') ? 'selected' : ''; ?>>Proficient</option>
                    </select>
                </div>

                <div class="level-form-group">
                    <label for="to-level" class="subject-label">To level</label>
                    <select class="wizard-form-control wizard-select-control level-select" id="to-level" name="to_level">
                        <option value="" selected disabled>-Select High level-</option>
                        <option value="beginner" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['to_level']) && $_SESSION['wizard_data']['subject-teach']['to_level'] == 'beginner') ? 'selected' : ''; ?>>Beginner</option>
                        <option value="elementary" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['to_level']) && $_SESSION['wizard_data']['subject-teach']['to_level'] == 'elementary') ? 'selected' : ''; ?>>Elementary</option>
                        <option value="intermediate" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['to_level']) && $_SESSION['wizard_data']['subject-teach']['to_level'] == 'intermediate') ? 'selected' : ''; ?>>Intermediate</option>
                        <option value="upper_intermediate" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['to_level']) && $_SESSION['wizard_data']['subject-teach']['to_level'] == 'upper_intermediate') ? 'selected' : ''; ?>>Upper Intermediate</option>
                        <option value="advanced" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['to_level']) && $_SESSION['wizard_data']['subject-teach']['to_level'] == 'advanced') ? 'selected' : ''; ?>>Advanced</option>
                        <option value="proficient" <?php echo (isset($_SESSION['wizard_data']['subject-teach']['to_level']) && $_SESSION['wizard_data']['subject-teach']['to_level'] == 'proficient') ? 'selected' : ''; ?>>Proficient</option>
                    </select>
                </div>
            </div>

            <button type="button" class="btn-add-subject">
                <span>Add Further Subject</span>
                <i class="fas fa-plus"></i>
            </button>

            <!-- Container for additional subjects -->
            <div id="additional-subjects-container">
                <?php
                if (isset($_SESSION['wizard_data']['subject-teach']['additional_subjects']) && is_array($_SESSION['wizard_data']['subject-teach']['additional_subjects'])) {
                    foreach ($_SESSION['wizard_data']['subject-teach']['additional_subjects'] as $index => $subject) {
                        $subjectId = "subject-" . ($index + 1);
                        $fromLevelId = "from-level-" . ($index + 1);
                        $toLevelId = "to-level-" . ($index + 1);
                ?>
                        <div class="subject-section" data-index="<?php echo $index + 1; ?>">
                            <div class="subject-form-group">
                                <label for="<?php echo $subjectId; ?>" class="subject-label">Subject</label>
                                <select class="wizard-form-control wizard-select-control subject-select" id="<?php echo $subjectId; ?>" name="subject_<?php echo $index + 1; ?>">
                                    <option value="" disabled>Set Language</option>
                                    <option value="english" <?php echo ($subject['subject'] == 'english') ? 'selected' : ''; ?>>English</option>
                                    <option value="mathematics" <?php echo ($subject['subject'] == 'mathematics') ? 'selected' : ''; ?>>Mathematics</option>
                                    <option value="science" <?php echo ($subject['subject'] == 'science') ? 'selected' : ''; ?>>Science</option>
                                    <option value="history" <?php echo ($subject['subject'] == 'history') ? 'selected' : ''; ?>>History</option>
                                    <option value="geography" <?php echo ($subject['subject'] == 'geography') ? 'selected' : ''; ?>>Geography</option>
                                    <option value="physics" <?php echo ($subject['subject'] == 'physics') ? 'selected' : ''; ?>>Physics</option>
                                    <option value="chemistry" <?php echo ($subject['subject'] == 'chemistry') ? 'selected' : ''; ?>>Chemistry</option>
                                    <option value="biology" <?php echo ($subject['subject'] == 'biology') ? 'selected' : ''; ?>>Biology</option>
                                    <option value="computer_science" <?php echo ($subject['subject'] == 'computer_science') ? 'selected' : ''; ?>>Computer Science</option>
                                    <option value="economics" <?php echo ($subject['subject'] == 'economics') ? 'selected' : ''; ?>>Economics</option>
                                    <option value="business_studies" <?php echo ($subject['subject'] == 'business_studies') ? 'selected' : ''; ?>>Business Studies</option>
                                    <option value="art" <?php echo ($subject['subject'] == 'art') ? 'selected' : ''; ?>>Art</option>
                                    <option value="music" <?php echo ($subject['subject'] == 'music') ? 'selected' : ''; ?>>Music</option>
                                    <option value="physical_education" <?php echo ($subject['subject'] == 'physical_education') ? 'selected' : ''; ?>>Physical Education</option>
                                </select>
                            </div>

                            <div class="level-form-container">
                                <div class="level-form-group">
                                    <label for="<?php echo $fromLevelId; ?>" class="subject-label">From level</label>
                                    <select class="wizard-form-control wizard-select-control level-select" id="<?php echo $fromLevelId; ?>" name="from_level_<?php echo $index + 1; ?>">
                                        <option value="" disabled>-Select lowest level-</option>
                                        <option value="beginner" <?php echo ($subject['from_level'] == 'beginner') ? 'selected' : ''; ?>>Beginner</option>
                                        <option value="elementary" <?php echo ($subject['from_level'] == 'elementary') ? 'selected' : ''; ?>>Elementary</option>
                                        <option value="intermediate" <?php echo ($subject['from_level'] == 'intermediate') ? 'selected' : ''; ?>>Intermediate</option>
                                        <option value="upper_intermediate" <?php echo ($subject['from_level'] == 'upper_intermediate') ? 'selected' : ''; ?>>Upper Intermediate</option>
                                        <option value="advanced" <?php echo ($subject['from_level'] == 'advanced') ? 'selected' : ''; ?>>Advanced</option>
                                        <option value="proficient" <?php echo ($subject['from_level'] == 'proficient') ? 'selected' : ''; ?>>Proficient</option>
                                    </select>
                                </div>

                                <div class="level-form-group">
                                    <label for="<?php echo $toLevelId; ?>" class="subject-label">To level</label>
                                    <select class="wizard-form-control wizard-select-control level-select" id="<?php echo $toLevelId; ?>" name="to_level_<?php echo $index + 1; ?>">
                                        <option value="" disabled>-Select High level-</option>
                                        <option value="beginner" <?php echo ($subject['to_level'] == 'beginner') ? 'selected' : ''; ?>>Beginner</option>
                                        <option value="elementary" <?php echo ($subject['to_level'] == 'elementary') ? 'selected' : ''; ?>>Elementary</option>
                                        <option value="intermediate" <?php echo ($subject['to_level'] == 'intermediate') ? 'selected' : ''; ?>>Intermediate</option>
                                        <option value="upper_intermediate" <?php echo ($subject['to_level'] == 'upper_intermediate') ? 'selected' : ''; ?>>Upper Intermediate</option>
                                        <option value="advanced" <?php echo ($subject['to_level'] == 'advanced') ? 'selected' : ''; ?>>Advanced</option>
                                        <option value="proficient" <?php echo ($subject['to_level'] == 'proficient') ? 'selected' : ''; ?>>Proficient</option>
                                    </select>
                                </div>
                            </div>

                            <button type="button" class="btn-remove-subject">
                                <i class="fas fa-times"></i> Remove
                            </button>
                        </div>

                        
                <?php }
                } ?>
            </div>
            <div class="wizard-form-actions">
                <button type="button" class="btn-save" id="save-subjects">Save</button>
                <button type="button" class="btn-next" id="next-step" data-next-step="education-experience">Next</button>
            </div>
        </div>
    </div>
    <!-- Form Actions -->

</div>
<?php
$js = <<<JS
        // Add new subject row
        $('#add-subject').on('click', function() {
            const subjectCount = $('#subject-container .subject-row').length + $('#additional-subjects-container .subject-section').length;
            
            // Clone the first subject row
            const newRow = $('#subject-container .subject-row:first').clone();
            
            // Reset values and update classes/IDs
            newRow.removeClass('subject-row').addClass('subject-section');
            newRow.attr('data-index', subjectCount);
            newRow.find('select').val('');
            
            // Update all input names and IDs
            newRow.find('select, input').each(function() {
                const name = $(this).attr('name');
                if (name) {
                    $(this).attr('name', name.replace(/\[\d*\]/, '[' + subjectCount + ']'));
                }
            });
            
            // Append to the additional subjects container
            $('#additional-subjects-container').append(newRow);
        });

        // Remove subject row
        $(document).on('click', '.btn-remove-subject', function() {
            const row = $(this).closest('.subject-row, .subject-section');
            const totalRows = $('#subject-container .subject-row').length + $('#additional-subjects-container .subject-section').length;
            
            // Check if there is more than one row
            if (totalRows > 1) {
                row.fadeOut(300, function() {
                    $(this).remove();
                });
            } else {
                alert('At least one subject must remain.');
            }
        });
    JS;
$this->registerJs($js);
?>