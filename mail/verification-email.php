<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email Address</title>
    <style>
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                padding: 20px 10px !important;
            }
            
            .content-container {
                padding: 30px 20px !important;
            }

            .button {
                width: 100% !important;
                padding: 14px 10px !important;
                font-size: 16px !important;
            }
            
            .heading {
                font-size: 22px !important;
            }
            
            .body-text {
                font-size: 15px !important; 
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; background-color: #f4f4f4; color: #666666; -webkit-font-smoothing: antialiased; width: 100%; height: 100%;">
    <table role="presentation" style="width: 100%; border-collapse: collapse; border: 0; border-spacing: 0; background-color: #f4f4f4; margin: 0; padding: 0; height: 100%;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <!-- Main Content Container -->
                <div class="email-container" style="max-width: 600px; margin: 0 auto; padding: 0; background: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                    
                    <!-- Card Content -->
                    <div class="content-container" style="padding: 40px 30px; text-align: center;">
                        
                        <!-- Email Icon -->
                        <div style="margin-bottom: 25px;">
                            <div style="display: inline-block; background-color: #e1eefe; border-radius: 50%; padding: 15px; width: 50px; height: 50px; text-align: center; line-height: 50px;">
                                <img src="https://cdn-icons-png.flaticon.com/128/561/561127.png" alt="Email icon" width="30" height="30" style="display: inline-block; vertical-align: middle;">
                            </div>
                        </div>
                        
                        <!-- Heading -->
                        <h1 class="heading" style="color: #333333; margin: 0 0 20px 0; font-size: 24px; font-weight: 600;">Verify Your Email Address</h1>
                        
                        <!-- Greeting and Instructions -->
                        <p class="body-text" style="margin: 0 0 25px 0; font-size: 16px; line-height: 1.5; color: #666666;">
                            Hi <?php echo htmlspecialchars($username); ?>,<br><br>
                            Thanks for signing up! Please verify your email<br>address to get started.
                        </p>
                        
                        <!-- Button -->
                        <div style="margin: 30px 0;">
                            <a href="<?php echo htmlspecialchars($verificationLink); ?>" class="button" style="background-color: #007bff; color: #ffffff; text-decoration: none; padding: 14px 35px; border-radius: 5px; font-weight: 600; font-size: 16px; display: inline-block; text-align: center; letter-spacing: 0.3px;">
                                Verify Email Address
                            </a>
                        </div>
                        
                        <!-- Alternative Link -->
                        <p class="body-text" style="margin: 25px 0; font-size: 14px; line-height: 1.5; color: #666666;">
                            Or click this link: <a href="<?php echo htmlspecialchars($verificationLink); ?>" style="color: #007bff; text-decoration: none;"><?php echo htmlspecialchars($verificationLink); ?></a>
                        </p>
                        
                        <!-- Divider -->
                        <div style="border-top: 1px solid #eeeeee; margin: 30px 0;"></div>
                        
                        <!-- Security Info -->
                        <p class="body-text" style="margin: 0 0 20px 0; font-size: 14px; line-height: 1.5; color: #999999;">
                            <img src="https://cdn-icons-png.flaticon.com/128/483/483408.png" alt="Lock icon" width="12" height="12" style="display: inline-block; vertical-align: middle; margin-right: 5px;">
                            This link will expire in 24 hours
                        </p>
                        
                        <!-- Help Text -->
                        <p class="body-text" style="margin: 0; font-size: 14px; line-height: 1.5; color: #666666;">
                            Didn't receive the email?<br>
                            <a href="#" style="color: #007bff; text-decoration: none;">Click here to resend</a>
                        </p>
                    </div>
                </div>
                
                <!-- Footer -->
                <div style="max-width: 600px; margin: 0 auto; padding: 20px 0; text-align: center;">
                    <p style="margin: 0; font-size: 13px; line-height: 1.5; color: #999999;">
                        Need help? <a href="#" style="color: #007bff; text-decoration: none;">Contact Support</a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="#" style="color: #999999; text-decoration: none;">Privacy Policy</a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="#" style="color: #999999; text-decoration: none;">Terms of Service</a>
                    </p>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>