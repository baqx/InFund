<?php
// functions.php - Contains all helper functions
function sanitizeInput($input) {
    global $conn;
    return mysqli_real_escape_string($conn, strip_tags(trim($input)));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    // At least 8 characters, 1 uppercase, 1 lowercase, 1 number
    return strlen($password) >= 8 && 
           preg_match('/[A-Z]/', $password) && 
           preg_match('/[a-z]/', $password) && 
           preg_match('/\d/', $password);
}

function isUsernameTaken($username) {
    global $conn;
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function isEmailTaken($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function isMatricNoTaken($matric_no) {
    global $conn;
    $stmt = $conn->prepare("SELECT id FROM users WHERE matric_no = ?");
    $stmt->bind_param("s", $matric_no);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function sendWelcomeEmail($email, $fullname) {
    require 'vendor/autoload.php'; // Make sure you have PHPMailer installed
    
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Update with your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Update with your email
        $mail->Password = 'your-app-password'; // Update with your app password
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Recipients
        $mail->setFrom('noreply@infund.com', 'INFund');
        $mail->addAddress($email, $fullname);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to INFund';
        $mail->Body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2>Welcome to INFund!</h2>
                <p>Dear {$fullname},</p>
                <p>Thank you for joining INFund. We're excited to have you as part of our community!</p>
                <p>You can now access your account and explore our platform's features.</p>
                <p>Best regards,<br>The INFund Team</p>
            </div>
        ";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email sending failed: {$mail->ErrorInfo}");
        return false;
    }
}