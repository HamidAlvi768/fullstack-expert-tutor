<?php
/**
 * Tutor Hero Component
 * 
 * @param array $props {
 *     @type string $background_image    Background image URL
 *     @type string $layout_type         Layout type ('full' or 'minimal')
 *     @type bool   $show_info_panel     Whether to show the info panel
 *     @type bool   $show_profile_image  Whether to show the profile image
 *     @type array  $profile {
 *         @type string $first_name      Tutor's first name
 *         @type string $last_name       Tutor's last name
 *         @type string $description     Short description or bio
 *         @type string $image           Profile image URL
 *     }
 *     @type array  $actions {
 *         @type array $buttons          Array of button configurations
 *     }
 *     @type array  $info_panel         Optional additional information panel
 * }
 */

// Default values
$default_props = [
    'background_image' => 'assets/images/tutor-summary-bg.jpg',
    'layout_type' => 'full',
    'show_info_panel' => false,
    'show_profile_image' => true,
    'profile' => [
        'first_name' => '',
        'last_name' => '',
        'description' => '',
        'image' => 'assets/images/profiles/teacher-1.jpg'
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

<!-- Tutor Hero Section Styles -->
<link rel="stylesheet" href="assets/css/components/tutor-hero.css">

<!-- Tutor Hero Section -->
<div class="tutor-hero-section <?php echo $props['layout_type']; ?>" 
     style="background-image: url('<?php echo $props['background_image']; ?>')">
    <div class="main-container container">
        <?php if ($props['layout_type'] === 'full'): ?>
            <!-- Include the header component for full layout -->
            <?php include 'includes/components/tutor-header.php'; ?>
        <?php endif; ?>
        
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
                            <img src="<?= Yii::getAlias('@web') ?>/assets/images/profiles/info-panel.jpg" alt="Tutor Information" class="info-panel-image">
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
</div> 