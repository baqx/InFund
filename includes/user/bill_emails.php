<?php
function sendReceiptEmail($email, $fullname, $billDetails, $paymentDetails)
{
    global $APP_EMAIL;
    global $APP_EMAIL_PASSWORD;
    global $APP_URL;
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $APP_EMAIL;
        $mail->Password = $APP_EMAIL_PASSWORD;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('baqee20072007@gmail.com', 'INFund');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Payment Receipt';

        // Dynamically generate the email content
        $mail->Body = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);'>
            <div style='background-color: #b36264; padding: 20px; text-align: center; color: white;'>
                <h1 style='margin: 0;'>Payment Receipt</h1>
            </div>
            <div style='padding: 20px;'>
                <p style='font-size: 16px; line-height: 1.5;'>Dear <strong>{$fullname}</strong>,</p>
                <p style='font-size: 16px; line-height: 1.5;'>Thank you for your payment. Below are the details of your transaction:</p>
                
                <h3>Payment Details</h3>
                <table style='width: 100%; border-collapse: collapse;'>
                    <tr>
                        <th style='text-align: left; padding: 8px; border-bottom: 1px solid #ddd;'>Field</th>
                        <th style='text-align: left; padding: 8px; border-bottom: 1px solid #ddd;'>Value</th>
                    </tr>
                    <tr>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>Bill Name</td>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>{$billDetails['name']}</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>Total Amount</td>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>₦" . number_format($billDetails['price'], 2) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>Amount Paid</td>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>₦" . number_format($paymentDetails['amount_paid'], 2) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>Balance</td>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>₦" . number_format($billDetails['price'] - $paymentDetails['amount_paid'], 2) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>Payment Status</td>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>{$paymentDetails['payment_status']}</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>Reference ID</td>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>{$paymentDetails['reference_id']}</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>Payment Date</td>
                        <td style='padding: 8px; border-bottom: 1px solid #ddd;'>" . date('F j, Y', strtotime($paymentDetails['last_payment_date'])) . "</td>
                    </tr>
                </table>
                
                <p style='font-size: 16px; line-height: 1.5;'>If you have any questions, feel free to reach out to our support team.</p>
                <p style='font-size: 16px; line-height: 1.5;'>Best regards,<br>The INFund Team</p>
                <div style='text-align: center; margin-top: 20px;'>
                    <a href='" . $APP_URL . "/dashboard/generate_receipt?id=" . $billDetails['id'] . "' style='background-color: #b36264; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'> Download Your Receipt</a>
                </div>
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
