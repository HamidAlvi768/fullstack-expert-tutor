<?php

use yii\helpers\Html;

?>

<style>
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

    .wizard-step-item a {
        text-decoration: none;
        color: inherit;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
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
</style>

<?php
$actionId = Yii::$app->controller->action->id;
?>

<!-- Sidebar -->
<div class="wizard-sidebar">
    <ul class="wizard-steps">
        <li class="wizard-step-item <?= ($actionId == "profile") ? "active" : "" ?>" data-step="teacher-profile">
            <?= Html::a('Profile', ['/tutor/profile']) ?>
        </li>
        <li class="wizard-step-item <?= ($actionId == "subjects") ? "active" : "" ?>" data-step="subject-teach">
            <?= Html::a('Teacher Subjects', ['/tutor/subjects']) ?>
        </li>
        <li class="wizard-step-item <?= ($actionId == "education") ? "active" : "" ?>" data-step="education-experience">
            <?= Html::a('Teacher Education', ['/tutor/education']) ?>
        </li>
        <li class="wizard-step-item <?= ($actionId == "professional-experience") ? "active" : "" ?>" data-step="professional-experience">
            <?= Html::a('Professional Experience', ['/tutor/professional-experience']) ?>
        </li>
        <li class="wizard-step-item <?= ($actionId == "teaching-details") ? "active" : "" ?>" data-step="teaching-details">
            <?= Html::a('Teaching Details', ['/tutor/teaching-details']) ?>
        </li>
        <li class="wizard-step-item <?= ($actionId == "description") ? "active" : "" ?>" data-step="description">
            <?= Html::a('Description', ['/tutor/description']) ?>
        </li>
    </ul>
</div>

