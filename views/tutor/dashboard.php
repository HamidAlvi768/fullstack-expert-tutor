<?php

use app\components\Helper;
use app\models\JobApplications;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Tutor Dashboard';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/tutor-hero.css');
echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/components/tutor-hero.css');

$firstName = isset($user->username) ? explode(' ', $user->username)[0] : 'Bryan';
$lastName = isset($user->username) && strpos($user->username, ' ') !== false 
            ? substr($user->username, strpos($user->username, ' ') + 1) 
            : 'Eigensection';

// Set up props for tutor-hero component
$profile_props = [
    'layout_type' => 'full',
    'background_image' => Yii::getAlias('@web') .'/assets/images/tutor-summary-bg.jpg',
    'show_info_panel' => false,
    'profile' => [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'description' => $tutor->description->description ?? "Hello,\nMy name is Christopher. I'm a student tutor with a passion for Mathematics and teaching young students. I'm young and vibrant with a passion for teaching and impacting knowledge to students",
        'image' => Yii::getAlias('@web') .'/assets/images/profiles/teacher-1.jpg'
    ],
    'actions' => [
        'buttons' => [
            ['text' => 'Message', 'class' => 'btn-message', 'type' => 'button'],
            ['text' => 'Call', 'class' => 'btn-call', 'type' => 'button'],
            ['text' => 'Review(' . (isset($rating) ? number_format($rating, 1) : '4.9') . ')', 'class' => 'btn-review', 'type' => 'button']
        ]
    ],
    'info_panel' => [
        [
            'icon' => 'fas fa-map-marker-alt',
            'label' => 'Location',
            'value' => 'Prince and Princess Estate, Kaura, Abuja'
        ],
        [
            'icon' => 'fas fa-car',
            'label' => 'Can travel',
            'value' => isset($wizardData['teaching-details']['willing_to_travel']) ? 
                ($wizardData['teaching-details']['willing_to_travel'] === 'yes' ? 'Yes' : 'No') : 'No'
        ]
    ]
];



$default_props = [
    'background_image' => Yii::getAlias('@web') .'/assets/images/tutor-summary-bg.jpg',
    'layout_type' => 'full',
    'show_info_panel' => false,
    'show_profile_image' => true,
    'profile' => [
        'first_name' => '',
        'last_name' => '',
        'description' => '',
        'image' => Yii::getAlias('@web') .'/assets/images/profiles/teacher-1.jpg'
    ],
    'actions' => [
        'buttons' => []
    ],
    'info_panel' => null
];

// Merge provided props with defaults
$props = isset($profile_props) ? array_merge($default_props, $profile_props) : $default_props;

// Ensure we have both first and last names
if (isset($props['profile']['full_name']) && !isset($props['profile']['first_name'])) {
    $name_parts = explode(' ', $props['profile']['full_name'], 2);
    $props['profile']['first_name'] = $name_parts[0];
    $props['profile']['last_name'] = isset($name_parts[1]) ? $name_parts[1] : '';
}
?>

    <style>
        .main-container{
            margin-top: 3rem;
        }
        .tutor-name{
            font-size: 6.5rem;
            width: max-content;
        }
        .tutor-name{
            text-align: center;
        }
        .tutor-info{
            display: flex;
            justify-content: center;
        }
        .tutor-profile-section{
            margin-top: 1.5rem;
        }
    </style>

<body class="jobs-page">

<div class="tutor-hero-section <?php echo $props['layout_type']; ?>" 
     style="background-image: url('<?php echo $props['background_image']; ?>')">
    <div class="main-container container">
        
        <!-- Tutor Profile Section -->
        <section class="tutor-profile-section <?php echo $props['layout_type']; ?> <?php echo $props['show_info_panel'] ? 'with-info-panel' : ''; ?>">
            <?php if ($props['layout_type'] === 'minimal'): ?>
                <div class="tutor-profile-minimal <?php echo !$props['show_profile_image'] ? 'no-image' : ''; ?>">
                    <?php if ($props['show_profile_image']): ?>
                    <div class="tutor-image">
                        <img src="<?php echo $props['profile']['image']; ?>" 
                             alt="<?php echo $props['profile']['first_name'] . ' ' . $props['profile']['last_name']; ?>"
                             loading="lazy">
                    </div>
                    <?php endif; ?>
                    <div class="tutor-info">
                        <h1 class="tutor-name">
                            <span class="first-name"><?php echo $props['profile']['first_name']; ?></span>
                            <span class="last-name"><?php echo $props['profile']['last_name']; ?></span>
                        </h1>
                        <?php if (!empty($props['profile']['description'])): ?>
                            <p class="tutor-short-bio"><?php echo $props['profile']['description']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="tutor-info">
                    <h1 class="tutor-name">
                        <span class="first-name"><?php echo $props['profile']['first_name']; ?></span>
                        <span class="last-name"><?php echo $props['profile']['last_name']; ?></span>
                    </h1>
                    
                    <?php if (!empty($props['profile']['description'])): ?>
                        <p class="tutor-short-bio"><?php echo $props['profile']['description']; ?></p>
                    <?php endif; ?>
                    
                    <?php if (!empty($props['actions']['buttons'])): ?>
                        <div class="tutor-actions">
                            <?php foreach ($props['actions']['buttons'] as $button): ?>
                                <button class="<?php echo $button['class']; ?>" type="<?php echo $button['type']; ?>">
                                    <?php echo $button['text']; ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="tutor-profile-right">
                    <?php if ($props['show_profile_image']): ?>
                    <div class="tutor-image">
                        <img src="<?php echo $props['profile']['image']; ?>" 
                             alt="<?php echo $props['profile']['first_name'] . ' ' . $props['profile']['last_name']; ?>"
                             loading="lazy">
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($props['show_info_panel'] && !empty($props['info_panel'])): ?>
                        <div class="info-panel">
                            <img src="assets/images/profiles/info-panel.jpg" alt="Tutor Information" class="info-panel-image">
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
</div> 

   <!-- Jobs Navigation -->
   <section class="jobs-navigation">
        <div class="container">
            <nav class="jobs-tabs">
                <a href="#" class="tab-link active">Best Matches</a>
                <a href="#" class="tab-link">Recent</a>
                <a href="#" class="tab-link">Job Saved</a>
            </nav>
            <p class="jobs-description">Explore job opportunities that align with your experience and the client's hiring criteria, sorted by relevance.</p>
        </div>
    </section>
    
    <!-- Jobs Listing -->
    <section class="jobs-listing">
        <div class="container">
        <?php foreach ($matched_posts as $model): ?>
            <div class="job-card">
                <div class="job-content">
                    <div class="job-header">
                        <h2 class="job-title"><?= Html::encode($model->title) ?></h2>
                        <div class="job-amount">
                            <span style="margin-right: 0.4rem;">Amount: </span>
                            <span class="amount-value"><?= Html::encode($model->budget) ?></span>
                            <span class="amount-currency">$</span>
                        </div>
                    </div>
                    <p class="job-description"><?= Html::encode(substr($model->details, 0, 150)) . '...' ?></p>
                    <?= Html::a(JobApplications::find()->where(['job_id'=>$model->id,'applicant_id'=>Yii::$app->user->identity->id])->one()?'Applied':'Apply', ['job-apply', 'id' => $model->id], ['class' => 'btn btn-success btn-sm ml-2']) ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>