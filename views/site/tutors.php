<?php

/** @var yii\web\View $this */

use app\components\Helper;
use yii\helpers\Html;

$this->title = 'Tutors';

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/tutors.css');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/tutors.js');

?>

        <!-- Hero Section -->
        <div class="tutors-page-hero-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="tutors-page-hero-content">
                            <h1 class="tutors-page-hero-title">
                                <span class="tutors-page-highlight">Tutors</span> <span class="tutors-page-from">from</span> <span class="tutors-page-normal">all</span>
                                <div class="tutors-page-subtitle">Country</div>
                            </h1>
                            <p class="tutors-page-hero-description">Find top talent or open assignments with tools that keep you in control.</p>
                            <div class="tutors-page-search-box">
                                <div class="tutors-page-search-input-wrapper">
                                    <i class="fas fa-search tutors-page-search-icon"></i>
                                    <input type="text" class="form-control" placeholder="Search">
                                </div>
                                <button class="btn btn-primary tutors-page-publish-btn">Publish Post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<section class="tutors-page-grid">
    <div class="container">
        <div class="tutors-page-grid-wrapper">
            <?php
            foreach ($tutors as $tutor):
            ?>
                <a href="<?php echo Helper::baseUrl("/tutor-profile?id={$tutor->id}") ?>" style="text-decoration: none;">
                    <div class="tutors-page-card">
                        <div class="tutors-page-card-header">
                            <img src="<?php Yii::getAlias('@web'); ?>/assets/images/avatars/avatar-1.png"
                                alt="<?php echo $tutor->username; ?>"
                                class="tutors-page-tutor-image">
                            <div class="tutors-page-rating">
                                <i class="fas fa-star"></i>
                                <span><?php echo count($tutor->reviews) ?></span>
                            </div>
                        </div>
                        <div class="tutors-page-card-info">
                            <h3 class="tutors-page-tutor-name"><?php echo $tutor->username; ?></h3>
                            <p class="tutors-page-tutor-location"><?php echo $tutor->profile->country; ?></p>
                            <div class="tutors-page-subjects">
                                <?php foreach ($tutor->subjects as $subject): ?>
                                    <span class="tutors-page-subject-tag"><?php echo $subject->subject; ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>