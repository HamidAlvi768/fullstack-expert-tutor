<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Teacher Job Description';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/profile.css');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile.js');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile-nav.js');
?>

<body class="profile-page">
    <div class="profile-main-content">
        <div class="container">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="teacher-teaching-details-form">
                <?php $form = ActiveForm::begin(['options' => ['class' => 'profile-form-container']]); ?>

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'description')->textarea(['rows' => '8', 'required' => true, 'class' => 'form-control profile-form-control'])->label('Job Role and Description') ?>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success profile-btn-save']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</body>