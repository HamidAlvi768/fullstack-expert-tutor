<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Profile';
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Html::cssFile(Yii::getAlias('@web') . '/assets/css/profile.css');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile.js');
echo Html::jsFile(Yii::getAlias('@web') . '/assets/js/profile-nav.js');

$countries = [
    'AF' => 'Afghanistan',
    'AL' => 'Albania',
    'DZ' => 'Algeria',
    'AD' => 'Andorra',
    'AO' => 'Angola',
    'AR' => 'Argentina',
    'AM' => 'Armenia',
    'AU' => 'Australia',
    'AT' => 'Austria',
    'AZ' => 'Azerbaijan',
    'BH' => 'Bahrain',
    'BD' => 'Bangladesh',
    'BY' => 'Belarus',
    'BE' => 'Belgium',
    'BZ' => 'Belize',
    'BJ' => 'Benin',
    'BT' => 'Bhutan',
    'BO' => 'Bolivia',
    'BA' => 'Bosnia and Herzegovina',
    'BW' => 'Botswana',
    'BR' => 'Brazil',
    'BN' => 'Brunei',
    'BG' => 'Bulgaria',
    'BF' => 'Burkina Faso',
    'BI' => 'Burundi',
    'KH' => 'Cambodia',
    'CM' => 'Cameroon',
    'CA' => 'Canada',
    'CV' => 'Cape Verde',
    'CF' => 'Central African Republic',
    'TD' => 'Chad',
    'CL' => 'Chile',
    'CN' => 'China',
    'CO' => 'Colombia',
    'KM' => 'Comoros',
    'CG' => 'Congo - Brazzaville',
    'CD' => 'Congo - Kinshasa',
    'CR' => 'Costa Rica',
    'CI' => 'Côte d’Ivoire',
    'HR' => 'Croatia',
    'CU' => 'Cuba',
    'CY' => 'Cyprus',
    'CZ' => 'Czech Republic',
    'DK' => 'Denmark',
    'DJ' => 'Djibouti',
    'DO' => 'Dominican Republic',
    'EC' => 'Ecuador',
    'EG' => 'Egypt',
    'SV' => 'El Salvador',
    'EE' => 'Estonia',
    'ET' => 'Ethiopia',
    'FI' => 'Finland',
    'FR' => 'France',
    'GA' => 'Gabon',
    'GM' => 'Gambia',
    'GE' => 'Georgia',
    'DE' => 'Germany',
    'GH' => 'Ghana',
    'GR' => 'Greece',
    'GT' => 'Guatemala',
    'GN' => 'Guinea',
    'HT' => 'Haiti',
    'HN' => 'Honduras',
    'HU' => 'Hungary',
    'IS' => 'Iceland',
    'IN' => 'India',
    'ID' => 'Indonesia',
    'IR' => 'Iran',
    'IQ' => 'Iraq',
    'IE' => 'Ireland',
    'IL' => 'Israel',
    'IT' => 'Italy',
    'JM' => 'Jamaica',
    'JP' => 'Japan',
    'JO' => 'Jordan',
    'KZ' => 'Kazakhstan',
    'KE' => 'Kenya',
    'KW' => 'Kuwait',
    'LA' => 'Laos',
    'LV' => 'Latvia',
    'LB' => 'Lebanon',
    'LY' => 'Libya',
    'LT' => 'Lithuania',
    'LU' => 'Luxembourg',
    'MG' => 'Madagascar',
    'MY' => 'Malaysia',
    'MV' => 'Maldives',
    'ML' => 'Mali',
    'MT' => 'Malta',
    'MX' => 'Mexico',
    'MD' => 'Moldova',
    'MC' => 'Monaco',
    'MN' => 'Mongolia',
    'MA' => 'Morocco',
    'MZ' => 'Mozambique',
    'MM' => 'Myanmar',
    'NA' => 'Namibia',
    'NP' => 'Nepal',
    'NL' => 'Netherlands',
    'NZ' => 'New Zealand',
    'NI' => 'Nicaragua',
    'NG' => 'Nigeria',
    'NO' => 'Norway',
    'OM' => 'Oman',
    'PK' => 'Pakistan',
    'PA' => 'Panama',
    'PG' => 'Papua New Guinea',
    'PY' => 'Paraguay',
    'PE' => 'Peru',
    'PH' => 'Philippines',
    'PL' => 'Poland',
    'PT' => 'Portugal',
    'QA' => 'Qatar',
    'RO' => 'Romania',
    'RU' => 'Russia',
    'RW' => 'Rwanda',
    'SA' => 'Saudi Arabia',
    'SN' => 'Senegal',
    'RS' => 'Serbia',
    'SG' => 'Singapore',
    'SK' => 'Slovakia',
    'SI' => 'Slovenia',
    'ZA' => 'South Africa',
    'KR' => 'South Korea',
    'ES' => 'Spain',
    'LK' => 'Sri Lanka',
    'SE' => 'Sweden',
    'CH' => 'Switzerland',
    'SY' => 'Syria',
    'TW' => 'Taiwan',
    'TZ' => 'Tanzania',
    'TH' => 'Thailand',
    'TN' => 'Tunisia',
    'TR' => 'Turkey',
    'UG' => 'Uganda',
    'UA' => 'Ukraine',
    'AE' => 'United Arab Emirates',
    'GB' => 'United Kingdom',
    'US' => 'United States',
    'UY' => 'Uruguay',
    'UZ' => 'Uzbekistan',
    'VE' => 'Venezuela',
    'VN' => 'Vietnam',
    'YE' => 'Yemen',
    'ZM' => 'Zambia',
    'ZW' => 'Zimbabwe',
];

?>

<body class="profile-page">
    <div class="profile-main-content">
        <div class="container">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="profile-form-container">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'profile-form-container']]); ?>

                <!-- Profile Photo Section -->
                <div class="profile-photo-upload">
                    <div class="profile-photo-placeholder">
                        <img src="<?= Yii::getAlias('@web') ?>/assets/images/profile-placeholder.jpg" alt="Upload Photo" id="profile-preview">
                    </div>
                    <?= $form->field($model, 'avatarFile')->fileInput(['id' => 'photo-upload', 'accept' => 'image/*', 'hidden' => true, 'class' => 'form-control profile-form-control'])->label(false) ?>
                    <label for="photo-upload" class="profile-upload-label">Upload Your Photo</label>
                </div>

                <!-- Form Grid -->
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'full_name')->textInput(['maxlength' => 100, 'required' => true, 'class' => 'form-control profile-form-control', 'placeholder' => 'Your Full Name']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'nick_name')->textInput(['maxlength' => 100, 'required' => true, 'class' => 'form-control profile-form-control', 'placeholder' => 'Your Nick Name']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'gender')->dropDownList([
                            'male' => 'Male',
                            'female' => 'Female'
                        ], ['prompt' => 'Select Gender', 'required' => true, 'class' => 'form-control profile-form-control profile-select-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'country')->dropDownList(
                            $countries,
                            ['prompt' => 'Select Your Country', 'class' => 'form-control profile-form-control profile-select-control', 'id' => 'country']
                        ) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'languages')->textInput(['maxlength' => 100, 'required' => true, 'class' => 'form-control profile-form-control', 'placeholder' => 'Your Language', 'id' => 'language']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'timezone')->dropDownList(
                            ArrayHelper::map(
                                DateTimeZone::listIdentifiers(DateTimeZone::ALL),
                                function ($timezone) {
                                    return $timezone;
                                },
                                function ($timezone) {
                                    $dateTime = new DateTime('now', new DateTimeZone($timezone));
                                    $offset = $dateTime->format('P');
                                    $label = "(GMT{$offset}) " . str_replace('_', ' ', $timezone);
                                    return $label;
                                }
                            ),
                            ['prompt' => 'GMT', 'required' => true, 'class' => 'form-control profile-form-control profile-select-control', 'id' => 'timezone']
                        ) ?>
                    </div>
                </div>

                <!-- Phone Verification -->
                <div class="form-group full-width">
                    <?= $form->field($model, 'phone_number')->textInput([
                        'maxlength' => 20,
                        'required' => true,
                        'class' => 'form-control profile-form-control',
                        'placeholder' => 'Enter Phone Number',
                        'id' => 'phone'
                    ])->label('Add Number To Verify') ?>
                </div>

                <!-- Submit Button -->
                <div class="form-group mt-4">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success profile-btn-save']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</body>