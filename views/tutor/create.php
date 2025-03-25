<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Tutor Profile';
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
    'CI' => 'Côte d\'Ivoire', // Escaped single quote to fix syntax error
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

<style>
.parent-container {
    display: flex;
    gap: 20px;
    max-width: 1320px;
    margin: 0 auto;
}

.profile-content {
    flex: 1;
}

.wizard-section-title {
    font-size: 24px;
    margin-bottom: 30px;
    color: #333;
}

.profile-photo-upload {
    text-align: center;
    margin-bottom: 30px;
}

.profile-photo-placeholder {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: #f8f9fa;
    margin: 0 auto 15px;
    cursor: pointer;
    overflow: hidden;
    border: 2px solid #e9ecef;
}

.profile-photo-placeholder img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.upload-your-photo {
    color: #6c757d;
    font-size: 14px;
    margin-top: 10px;
}

.wizard-form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.wizard-form-group {
    margin-bottom: 20px;
}

.wizard-form-control {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
}

.wizard-select-control {
    height: 45px;
}

.subject-label {
    display: block;
    margin-bottom: 8px;
    color: #495057;
    font-weight: 500;
}

.form-actions {
    margin-top: 30px;
    text-align: center;
}

.btn-save {
    background: #6366F1;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-save:hover {
    background: #4F46E5;
}
</style>

<body class="profile-page">
    <div class="parent-container">
        <?php echo $this->render('_sidebar'); ?>
        
        <div class="profile-content">
            <div class="container">

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'profile-form-container']]); ?>

                <!-- Profile Photo Upload -->
                <div class="profile-photo-upload">
                    <div class="profile-photo-placeholder" id="profile-photo-container">
                        <img src="<?= Yii::getAlias('@web') ?>/assets/images/profiles/teacher-avatar.jpg" alt="Profile Photo" id="profile-preview">
                        <?= $form->field($model, 'avatarFile')->fileInput([
                            'hidden' => true,
                            'id' => 'profile-upload',
                            'onchange' => 'readURL(this);'
                        ])->label(false) ?>
                    </div>
                    <div class="upload-your-photo">Upload Your Photo</div>
                </div>

                <!-- Form Fields -->
                <div class="wizard-form-grid">
                    <div class="wizard-form-group">
                        <?= $form->field($model, 'full_name')->textInput([
                            'class' => 'wizard-form-control',
                            'placeholder' => 'Full Name'
                        ])->label('Full Name', ['class' => 'subject-label']) ?>
                    </div>

                    <div class="wizard-form-group">
                        <?= $form->field($model, 'nick_name')->textInput([
                            'class' => 'wizard-form-control',
                            'placeholder' => 'Nick Name'
                        ])->label('Nick Name', ['class' => 'subject-label']) ?>
                    </div>

                    <div class="wizard-form-group">
                        <?= $form->field($model, 'gender')->dropDownList([
                            'male' => 'Male',
                            'female' => 'Female'
                        ], [
                            'prompt' => 'Select Gender',
                            'class' => 'wizard-form-control wizard-select-control'
                        ])->label('Gender', ['class' => 'subject-label']) ?>
                    </div>

                    <div class="wizard-form-group">
                        <?= $form->field($model, 'country')->dropDownList(
                            $countries,
                            [
                                'prompt' => 'Select Your Country',
                                'class' => 'wizard-form-control wizard-select-control'
                            ]
                        )->label('Country', ['class' => 'subject-label']) ?>
                    </div>

                    <div class="wizard-form-group">
                        <?= $form->field($model, 'languages')->textInput([
                            'class' => 'wizard-form-control',
                            'placeholder' => 'Your Language'
                        ])->label('Language', ['class' => 'subject-label']) ?>
                    </div>

                    <div class="wizard-form-group">
                        <?= $form->field($model, 'timezone')->dropDownList(
                            ArrayHelper::map(
                                DateTimeZone::listIdentifiers(DateTimeZone::ALL),
                                function ($timezone) { return $timezone; },
                                function ($timezone) {
                                    $dateTime = new DateTime('now', new DateTimeZone($timezone));
                                    $offset = $dateTime->format('P');
                                    return "(UTC/GMT{$offset}) " . str_replace('_', ' ', $timezone);
                                }
                            ),
                            [
                                'prompt' => 'Select Timezone',
                                'class' => 'wizard-form-control wizard-select-control'
                            ]
                        )->label('Timezone', ['class' => 'subject-label']) ?>
                    </div>

                    <div class="wizard-form-group">
                        <?= $form->field($model, 'phone_number')->textInput([
                            'class' => 'wizard-form-control',
                            'placeholder' => 'Phone Number'
                        ])->label('Phone Number', ['class' => 'subject-label']) ?>
                    </div>
                </div>

                <div class="form-actions">
                    <?= Html::submitButton('Save', ['class' => 'btn-save']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</body>

<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $('#profile-preview').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    $('#profile-photo-container').click(function() {
        $('#profile-upload').click();
    });
});
</script>