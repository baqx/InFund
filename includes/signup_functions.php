<?php
// functions.php - Contains all helper functions


function sendWelcomeEmail($email, $fullname)
{

    global $APP_EMAIL;
    global $APP_EMAIL_PASSWORD;
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Update with your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = $APP_EMAIL; // Your SMTP email
        $mail->Password = $APP_EMAIL_PASSWORD;    // Your SMTP password
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('baqee20072007@gmail.com', 'INFund');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to INFund';
        $mail->Body = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);'>
        <div style='background-color: #b36264; padding: 20px; text-align: center; color: white;'>
            <h1 style='margin: 0;'>Welcome to INFund!</h1>
        </div>
        <div style='padding: 20px;'>
            <p style='font-size: 16px; line-height: 1.5;'>Dear <strong>{$fullname}</strong>,</p>
            <p style='font-size: 16px; line-height: 1.5;'>Thank you for joining INFund. We're excited to have you as part of our community!</p>
            <p style='font-size: 16px; line-height: 1.5;'>You can now access your account and explore our platform's features.</p>
            <p style='font-size: 16px; line-height: 1.5;'>To get started, we recommend checking out the following:</p>
            <ul style='list-style-type: disc; margin-left: 20px;'>
                <li style='margin-bottom: 10px;'>Explore your dashboard to see campaigns.</li>
                <li style='margin-bottom: 10px;'>Share INFund to your friends.</li>
                </ul>
            <p style='font-size: 16px; line-height: 1.5;'>If you have any questions, feel free to reach out to our support team.</p>
            <p style='font-size: 16px; line-height: 1.5;'>Best regards,<br>The INFund Team</p>
        </div>
        <div style='background-color: #f1f1f1; padding: 10px; text-align: center;'>
            <p style='font-size: 14px; margin: 0;'>© " . date('Y') . " INFund. All rights reserved.</p>
        </div>
    </div>
";
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email sending failed: {$mail->ErrorInfo}");
        return false;
    }
}
