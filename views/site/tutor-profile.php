<?php

/** @var yii\web\View $this */

use app\components\Helper;
use yii\helpers\Html;


$this->title = 'Tutors';
echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/tutor-hero.css');
echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/components/tutor-hero.css');
echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/profile-navigation.css');

 // Get name parts for the updated component
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
>

  <style>
        /* Description Section Styles */
        .tutor-description {
            padding: 40px 0;
            text-align: justify;
            display: flex;
            flex-direction: column;
        }

        .description-text {
            margin-bottom: 30px;
            line-height: 1.8;
            color: #1B1B3F;
        }

        .description-text p {
            margin-bottom: 20px;
        }

        .btn-more-info {
            background-color: #564FFD;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 0 auto;
        }

        .btn-more-info:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .tutor-description {
                padding: 30px 15px;
            }
        }
    </style>

    <!-- Tutor Hero Section Styles -->

<!-- Tutor Hero Section -->
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


<div class="main-container container">
        <!-- Tutor Description Section -->
        <section class="tutor-description">
            <div class="description-text">
                <p>Hello Christopher! It's great to meet you, and it sounds like you have an incredible passion for teaching and a strong commitment to helping students succeed in Mathematics. Based on what you've shared, here's a more detailed description you could use to showcase your skills and experience:</p>
                
                <p>Christopher: Passionate Mathematics Tutor Committed to Student Success</p>
                
                <p>Hello! My name is Christopher, and I am a dedicated and enthusiastic student tutor with a deep passion for Mathematics and a genuine desire to help young learners excel. With a strong focus on building a solid foundation in mathematical concepts, I aim to make learning not only effective but also engaging and enjoyable for students at all levels.</p>
                
                <p>As an up-to-date tutor, I stay current with the latest high school and elementary school curriculums to ensure I provide students with the most relevant and accurate content. I specialize in preparing students for common entrance exams and work extensively with students preparing for entrance exams at institutions such as Loyola Jesuit College, Gidan Mangoro, Abuja. My approach to tutoring is both comprehensive and tailored, taking into consideration the individual learning style and pace of each student.</p>
                
                <p>With a high coaching success rate, I am proud of my ability to break down complex mathematical concepts into understandable steps, helping my students not only to grasp challenging topics but also to develop a true appreciation for the subject. I believe that patience, clear explanations, and constant encouragement are key to student success, and I go the extra mile to ensure that every student has the support they need to succeed.</p>
                
                <p>Whether it's helping students master foundational math skills or preparing them for critical exams, my focus is on creating a positive learning environment where students feel confident, capable, and motivated to achieve their academic goals.</p>
                
                <p>How does that sound? Feel free to let me know if you'd like to add or change anything!</p>
            </div>
            
            <button class="btn-more-info">More Information</button>
        </section>
    </div>
