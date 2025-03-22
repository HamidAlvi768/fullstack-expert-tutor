<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>

<!-- Hero Section -->
<?php include 'includes/sections/hero.php'; ?>

<!-- Stats Section -->
<?php
require_once 'includes/components/stat-item.php';

$stats = [
    ['fas fa-users', '#FF6B6B', '67.1', 'k', 'Students'],
    ['fas fa-certificate', '#564FFD', '26', 'k', 'Certified Instructor'],
    ['fas fa-globe', '#FF6B6B', '72', '', 'Country Language'],
    ['fas fa-check-circle', '#4CD137', '99.9', '%', 'Success Rate']
];

renderStatsSection($stats);
?>
</div>

<!-- Partners Section -->
<?php include 'includes/sections/partners.php'; ?>

<!-- Features Section -->
<?php include 'includes/sections/features.php'; ?>

<!-- Subjects Section -->
<?php
require_once 'includes/components/subject-card.php';

$subjects = [
    ['✍', 'Mathematics', 'Proin egestas, nisi vitae hendrerit maximus, mauris nunc facilisis odi.'],
    ['✍', 'Science', 'Proin egestas, nisi vitae hendrerit maximus, mauris nunc facilisis odi.'],
    ['✍', 'Science', 'Proin egestas, nisi vitae hendrerit maximus, mauris nunc facilisis odi.'],
    ['✍', 'Content Writing', 'Proin egestas, nisi vitae hendrerit maximus, mauris nunc facilisis odi.'],
    ['✍', 'Commerce Stream', 'Proin egestas, nisi vitae hendrerit maximus, mauris nunc facilisis odi.'],
    ['✍', 'Humanities', 'Proin egestas, nisi vitae hendrerit maximus, mauris nunc facilisis odi.'],
    ['✍', 'For Arts and Design', 'Proin egestas, nisi vitae hendrerit maximus, mauris nunc facilisis odi.'],
    ['✍', 'Content Writing', 'Proin egestas, nisi vitae hendrerit maximus, mauris nunc facilisis odi.']
];

renderSubjectsSection($subjects);
?>

<!-- CTA Section -->
<?php include 'includes/sections/cta.php'; ?>

<!-- Teacher Section -->
<?php include 'includes/sections/teacher.php'; ?>

<!-- Reviews Section -->
<?php
require_once 'includes/components/review-card.php';

$reviews = [
    [
        'assetsimages/reviewers/guy-hawkins.png',
        'Guy Hawkins',
        '1 week ago',
        5,
        'I appreciate the precise short videos (10 mins or less each) because overly long videos tend to make me lose focus. The instructor is very knowledgeable in Web Design and it shows as he shares his knowledge. These were my best 6 months of training. Thanks, Vako.'
    ],
    [
        'assetsimages/reviewers/bessie-cooper.png',
        'Bessie Cooper',
        '6 hours ago',
        5,
        'Webflow course was good, it covers design secrets, and to build responsive web pages, blog, and some more tricks and tips about webflow. I enjoyed the course and it helped me to add web development skills related to webflow in my toolbox. Thank you Vako.'
    ],
    [
        'assetsimages/reviewers/dianne-russell.png',
        'Dianne Russell',
        '51 mins ago',
        5,
        'This course is just amazing! has great course content, the best practices, and a lot of real-world knowledge. I love the way of giving examples, the best tips by the instructor which are pretty interesting, fun and knowledgable and I was never getting bored throughout the course.'
    ],
    [
        'assetsimages/reviewers/eleanor-pena.png',
        'Eleanor Pena',
        '1 days ago',
        5,
        'I appreciate the precise short videos (10 mins or less each) because overly long videos tend to make me lose focus. The instructor is very knowledgeable in Web Design and it shows as he shares his knowledge. These were my best 6 months of training. Thanks, Vako.'
    ]
];

renderReviewsSection($reviews);
?>