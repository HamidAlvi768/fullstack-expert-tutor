<?php

namespace app\components;

use DateTimeZone;
use PhpParser\Node\Expr\StaticCall;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Yii;
use yii\helpers\Html;

class Helper
{
    public static function getRoles()
    {
        return [
            'superadmin' => 'Super Admin',
            'admin' => 'Admin',
            'client' => 'Client',
            // 'driver' => 'Driver',
        ];
    }
    public static function getBookingStatus($notNeedStatusArray = null)
    {
        $status = [
            'Quoted' => 'Quoted',
            'Confirmed' => 'Confirmed',
            'Onway' => 'On the Way',
            'Delivered' => 'Delivered',
            'Canceled' => 'Canceled',
        ];
        if ($notNeedStatusArray != null) {
            foreach ($notNeedStatusArray as $key) {
                unset($status[$key]);
            }
        }
        return $status;
    }

    public static function generateRandomString()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // 26 letters + 10 digits
        $result = '';

        for ($i = 0; $i < 11; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $result .= $characters[$randomIndex];
        }

        return $result;
    }
    // public static function logo()
    // {
    //     echo self::baseUrl("assets/images/logo.png");
    // }

    public static function logo()
{
    echo Yii::getAlias('@web') . "/assets/images/logo.png";
}
    public static function baseUrl($path = '')
    {
        if (class_exists('\Yii')) {
            return \Yii::$app->getUrlManager()->createAbsoluteUrl($path);
        }

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $host = $_SERVER['HTTP_HOST'];
        $baseUrl = $protocol . $host . '/';

        return $baseUrl . ltrim($path, '/');
    }

    public static function oldOrNewValue($fieldName, $newValue = '')
    {
        if (isset($_POST[$fieldName])) {
            return htmlspecialchars($_POST[$fieldName], ENT_QUOTES, 'UTF-8');
        }
        return htmlspecialchars($newValue, ENT_QUOTES, 'UTF-8');
    }
    public static function csrf()
    {
        echo Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken);
    }

    public static function generateContent($data, $page_path)
    {
        // Check if the file exists
        if (!file_exists($page_path)) {
            return "Page file not found";
        }

        // Start output buffering to capture the content of the page
        ob_start();

        // Extract the data array to make its keys accessible as variables
        extract($data);

        // Include the page file
        include $page_path;

        // Get the captured content
        $content = ob_get_clean();

        return $content;
    }
    public static function generateRandomPassword($length = 8)
    {
        return Yii::$app->security->generateRandomString($length); // Random string for password
    }


    // function to round prices
    public static function roundPrice($price)
    {
        return round($price);
    }

    // Send Verification Email
    public static function SendVerificationMail($to, $name, $verificationLink)
    {
        try {
            return Yii::$app->mailer->compose('verification-email', [
                'username' => $name,
                'verificationLink' => $verificationLink
            ])
                ->setTo($to)
                ->setFrom(['twenty47logistics@leightonbuzzardairportcabs.co.uk' => 'Expert Tutor'])
                ->setSubject('Verify your email address')
                ->send();
        } catch (\Exception $e) {
            Yii::error('Failed to send verification email: ' . $e->getMessage());
            return false;
        }
    }

    public static function getTimeZones()
    {
        $timezones = [];
        $identifiers = DateTimeZone::listIdentifiers();

        foreach ($identifiers as $identifier) {
            $timezones[$identifier] = $identifier;
        }

        return $timezones;
    }

    public static function generateReferralCode($userName, $userId)
    {
        $cleanUserName = preg_replace('/[^A-Za-z0-9]/', '', $userName);
        $currentTime = date('YmdHis');
        $randomPart = substr(md5(uniqid(rand(), true)), 0, 4);
        return "{$cleanUserName}{$userId}{$currentTime}{$randomPart}";
    }
}
