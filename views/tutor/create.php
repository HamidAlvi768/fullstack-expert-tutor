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
            <div class="profiles-form">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'avatarFile')->fileInput(['required' => false]) ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'full_name')->textInput(['maxlength' => 100, 'required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'nick_name')->textInput(['maxlength' => 100, 'required' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'gender')->dropDownList([
                            'male' => 'Male',
                            'female' => 'Female'
                        ], ['prompt' => 'Select Gender', 'required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'country')->dropDownList(
                            $countries,
                            ['prompt' => 'Select Your Country', 'class' => 'form-control', 'id' => 'country']
                        ) ?>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">

<?= $form->field($model, 'languages')->textInput(['maxlength' => 100, 'required' => true, 'class' => 'form-control', 'placeholder' => 'Your Language', 'id' => 'language']) ?>
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
                                    $tzInfo = new DateTimeZone($timezone);
                                    $transitions = $tzInfo->getTransitions(time(), time() + 31536000);
                                    $hasDst = count($transitions) > 1;
                                    $label = "(UTC/GMT{$offset}";
                                    if ($hasDst) {
                                        $label .= "†";
                                    }
                                    $label .= ") " . str_replace('_', ' ', $timezone);
                                    return $label;
                                }
                            ),
                            [
                                'prompt' => 'Select Timezone',
                                'required' => true,
                                'options' => [
                                    'style' => 'max-width: 100%;'
                                ]
                            ]
                        ) ?>
                    </div>
                </div>

                <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 20, 'required' => true]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</body>
