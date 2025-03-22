<?php

use app\components\Helper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Tutor Dashboard';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .job-link {
        color: gray;
        text-decoration: none;
    }

    .job-link.active {
        color: blue;
    }
</style>

<div class="p-5">

    <!-- HEADER -->
    <div class="row">
        <div class="w-100 bg-secondary text-dark p-5 rounded">
            <div class="text-center">
                <h1><?= $user->username ?></h1>
            </div>
        </div>
    </div>
    <!-- HEADER -->

    <?php


    $actionId = Yii::$app->controller->action->id;
    ?>

    <div class="jobs-nav row mt-3">
        <ul class="flex p-1" style="display:flex; gap:20px;">
            <?= Html::a('Best Matches', ['/tutor/dashboard'], ['class' => 'job-link ' . ($actionId == "dashboard" ? "active" : "")]) ?>

            <?= Html::a('Recent', ['/tutor/jobs/recent'], ['class' => 'job-link ' . ($actionId == "recent-jobs" ? "active" : "")]) ?>

            <?= Html::a('Saved Jobs', ['/tutor/jobs/saved'], ['class' => 'job-link ' . ($actionId == "saved-jobs" ? "active" : "")]) ?>
        </ul>
    </div>
    <div class="">
        <p>Explore job oportunities taht align with your experience and the clients hiring criteria, sorted by relevance.</p>
    </div>
    <div class="row g-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h4><?= $post->title ?></h4>
                        <p><?= $post->details ?></p>
                    </div>
                    <div class="col-5">
                        <div class="" style="background-color: lightgray;padding:20px;">
                            <div class="row g-3">
                                <?php
                                $messagePrice = 30;
                                $callPrice = 50;
                                ?>
                                <div class="col-md-12">
                                    <a href="<?php echo $applied ? Helper::baseUrl("peoples/chat?other={$post->getPostedBy()->one()->id}&post={$post->id}") : Helper::baseUrl("tutor/apply-now?id={$post->id}&coins={$messagePrice}&url=") . Helper::baseUrl("peoples/chat?other={$post->getPostedBy()->one()->id}&post={$post->id}") ?>" class="btn btn-lg btn-success" style="width: 100%;display:flex; justify-content:space-between;">
                                        <span>Message</span>
                                        <span><?php echo $applied ? "Applied" : "Coins " . $messagePrice; ?></span>
                                    </a>
                                </div>
                                <div class="col-md-12">
                                    <a href="" class="btn btn-lg btn-primary" style="width: 100%;display:flex; justify-content:space-between;">
                                        <span>Call</span>
                                        <span>Coins <?= $callPrice; ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>