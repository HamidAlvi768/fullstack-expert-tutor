<?php

use app\models\Profiles;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Student Job Post';
$this->params['breadcrumbs'][] = ['label' => 'Student Job Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/profile.css');
echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/request-tutor.css');

?>

<body class="request-tutor-page">
    <div class="request-tutor-main">
        <div class="container">
            <h1><?= Html::encode($this->title) ?></h1>

            <div class="request-tutor-form">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'title')->textInput(['maxlength' => 255, 'required' => true]) ?>

                <?= $form->field($model, 'details')->textarea(['rows' => 6, 'required' => true]) ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'location')->textInput(['maxlength' => 100, 'required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 100, 'readonly' => true, 'value' => Profiles::find()->where(['user_id' => Yii::$app->user->identity->id])->one()->phone_number]); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'subject')->textInput(['maxlength' => 100, 'required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'level')->textInput(['maxlength' => 100]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'meeting_option')->dropDownList([
                            'online' => 'Online',
                            'in-person' => 'In Person',
                            'both' => 'Both'
                        ], ['prompt' => 'Select Meeting Option']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'post_code')->textInput(['maxlength' => 20]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'budget')->textInput(['type' => 'number']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'gender')->dropDownList([
                            'male' => 'Male',
                            'female' => 'Female',
                            'any' => 'Any'
                        ], ['prompt' => 'Select Gender']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'tutor_from')->textInput(['maxlength' => 100]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'want')->textarea(['rows' => 3])->label('I want'); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'need_some')->textarea(['rows' => 3]) ?>
                    </div>
                </div>
                <div class="profile-form-actions">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success profile-btn-save']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
