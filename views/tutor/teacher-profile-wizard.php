<?php
session_start();

// Determine which step to display
$currentStep = isset($_GET['step']) ? $_GET['step'] : 'teacher-profile';

// Validate step name for security
$validSteps = ['teacher-profile', 'subject-teach', 'education-experience', 'professional-experience', 'teaching-details', 'description'];
if (!in_array($currentStep, $validSteps)) {
    $currentStep = 'teacher-profile'; // Default to first step if invalid
}

// Store current step in session
$_SESSION['current_wizard_step'] = $currentStep;
?>

<style>
    .profile-page::before {
        background: #f8f9fa;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Profile Wizard - Tutor Expert</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/utils/utilities.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/profile-navigation.css">
    <link rel="stylesheet" href="assets/css/wizard-common.css">
    <style>
        /* Teacher Profile Wizard Specific Styles */
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        
        .wizard-container {
            display: flex;
            min-height: calc(100vh - 150px);
            margin-top: 20px;
            margin-bottom: 20px;
        }
        
        /* Sidebar Styles */
        .wizard-sidebar {
            width: 300px;
            background-color: transparent;
            border-radius: 10px;
            padding: 0;
            margin-right: 20px;
            font-size: large;
        }
        
        .wizard-steps {
            list-style: none;
            padding: 30px 0;
            margin: 0;
            border-right: 1px solid rgba(0, 0, 0, 0.1);
            height: 80%;
        }
        
        .wizard-step-item {
            padding: 22px 30px;
            display: flex;
            align-items: center;
            color: #6c757d;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .wizard-step-item.active {
            color: #6366F1;
            font-weight: 600;
        }
        
        .wizard-step-item:hover:not(.active) {
            background: #f8f9fa;
        }
        
        .wizard-step-item::before {
            content: '•';
            margin-right: 10px;
            font-size: 20px;
        }
        
        /* Main Content Area */
        .wizard-content {
            flex: 1;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }
        
        /* Form Styles */
        .wizard-form-container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        /* Section Title */
        .wizard-section-title {
            font-size: 24px;
            font-weight: 600;
            color: #1B1B3F;
            margin-bottom: 30px;
        }
        
        /* Form grid for profile fields */
        
        .wizard-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 30px;
        }
        
        .wizard-form-group {
            margin-bottom: 20px;
        }
        
        .subject-form-container {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
        
        .subject-form-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .subject-label {
            font-size: 16px;
            font-weight: 500;
            color: #1B1B3F;
        }
        
        .level-form-container {
            display: flex;
            gap: 20px;
        }
        
        .level-form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .wizard-form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
            background-color: #F3F3F3;
            color: #140489;
        }
        
        .wizard-form-control:focus {
            border-color: #6366F1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
            outline: none;
        }
        
        .wizard-select-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236c757d' viewBox='0 0 16 16'%3E%3Cpath d='M8 10.5a.5.5 0 0 1-.354-.146l-4-4a.5.5 0 0 1 .708-.708L8 9.293l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.354.146z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 12px;
            padding-right: 40px;
            color: gray !important;
        }
        
        .subject-select, .level-select {
            background: #f8f9fa;
            color: #6c757d;
            height: 50px;
        }
        
        /* Add Subject Button */
        .btn-add-subject {
            background-color: #564FFD;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 250px;
            margin-top: 10px;
        }
        
        .btn-add-subject i {
            font-size: 10px !important;
            margin-left: unset !important;
            border: 2px solid;
            border-radius: 50%;
            padding: 3px;
        }
        
        .btn-add-subject:hover {
            background-color: #4a43e2;
        }
        
        /* Remove Subject Button */
        .btn-remove-subject {
            background: #f8f9fa;
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
            margin-top: 10px;
        }
        
        .btn-remove-subject:hover {
            background-color: #feecef;
        }
        
        .subject-section {
            border-top: 1px solid #e9ecef;
            padding-top: 25px;
            margin-top: 10px;
        }
        
        /* Button Styles */
        .wizard-form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 50px;
            gap: 15px;
        }
        
        .btn-save {
            background-color: white;
            color: #6366F1;
            border: 1px solid #6366F1;
            padding: 10px 40px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-save:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }
        
        .btn-next {
            background-color: #6366F1;
            color: white;
            border: none;
            padding: 10px 40px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-next:hover {
            background-color: #5152e2;
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .level-form-container {
                flex-direction: column;
                gap: 15px;
            }
        }
        
        @media (max-width: 768px) {
            .wizard-container {
                flex-direction: column;
            }
            
            .wizard-sidebar {
                width: 100%;
                margin-right: 0;
                margin-bottom: 20px;
            }
            
            .wizard-steps {
                border-right: none;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                height: auto;
                padding: 15px 0;
            }
        }
        
        /* Photo Upload Styles */
        .profile-photo-upload {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 30px;
            gap: 0.8rem;
        }
        
        .profile-photo-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 15px;
            position: relative;
            background-color: #f0f1ff;
            cursor: pointer;
            background: linear-gradient(135deg, #c471ed, #8a3cda);
        }
        
        .profile-photo-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }
        
        .upload-your-photo {
            font-size: 15px;
            color: black;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Include Top Header -->
    <?php include 'includes/components/top-header.php'; ?>

    <!-- Include Main Navigation -->
    <?php include 'includes/components/main-nav.php'; ?>

    <!-- Wizard Container -->
    <div class="container">
        <div class="wizard-container">
            <!-- Sidebar -->
            <div class="wizard-sidebar">
                <ul class="wizard-steps">
                    <li class="wizard-step-item <?php echo ($currentStep == 'teacher-profile') ? 'active' : ''; ?>" data-step="teacher-profile">Teacher Profile</li>
                    <li class="wizard-step-item <?php echo ($currentStep == 'subject-teach') ? 'active' : ''; ?>" data-step="subject-teach">Subject Teach</li>
                    <li class="wizard-step-item <?php echo ($currentStep == 'education-experience') ? 'active' : ''; ?>" data-step="education-experience">Education /Experience</li>
                    <li class="wizard-step-item <?php echo ($currentStep == 'professional-experience') ? 'active' : ''; ?>" data-step="professional-experience">Professional Experience</li>
                    <li class="wizard-step-item <?php echo ($currentStep == 'teaching-details') ? 'active' : ''; ?>" data-step="teaching-details">Teaching Details</li>
                    <li class="wizard-step-item <?php echo ($currentStep == 'description') ? 'active' : ''; ?>" data-step="description">Description</li>
                </ul>
            </div>
            
            <!-- Main Content -->
            <div class="wizard-content">
                <form class="wizard-form-container" id="wizard-form">
                    <?php 
                    // Include the current step file
                    $stepFilePath = "includes/wizard-steps/{$currentStep}.php";
                    if (file_exists($stepFilePath)) {
                        include $stepFilePath;
                    } else {
                        echo "<p>Step file not found: {$stepFilePath}</p>";
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Navigation JS -->
    <script src="assets/js/profile-nav.js"></script>
    
    <script>
        // Make sidebar steps clickable
        document.addEventListener('DOMContentLoaded', function() {
            const stepItems = document.querySelectorAll('.wizard-step-item');
            
            stepItems.forEach(item => {
                item.addEventListener('click', function() {
                    const step = this.getAttribute('data-step');
                    if (step) {
                        window.location.href = 'teacher-profile-wizard.php?step=' + step;
                    }
                });
            });
        });
    </script>
</body>
</html> 