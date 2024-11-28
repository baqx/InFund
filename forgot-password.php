<?php
session_start();
require './config/config.php'; // Assuming you have a database connection file
require './config/secrets.php';
require './vendor/autoload.php'; // PHPMailer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generateResetToken($length = 32)
{
    return bin2hex(random_bytes($length));
}

function sendResetEmail($email, $resetLink)
{
    global $APP_EMAIL;
    global $APP_EMAIL_PASSWORD;
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration (replace with your email service details)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Your SMTP host
        $mail->SMTPAuth   = true;
        $mail->Username   = $APP_EMAIL; // Your email
        $mail->Password   = $APP_EMAIL_PASSWORD; // App password or SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email content
        $mail->setFrom('noreply@infund.com', 'INFund Password Reset');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset for INFund Account';
        $mail->Body    = "
            <h2>Password Reset Request</h2>
            <p>Click the link below to reset your password:</p>
            <a href='{$resetLink}'>Reset Password</a>
            <p>This link will expire in 12 hours.</p>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email sending failed: " . $mail->ErrorInfo);
        return false;
    }
}

function createPasswordResetEntry($email, $token)
{
    global $conn; // Assuming $conn is your database connection

    // Delete any existing reset tokens for this email
    $deleteStmt = $conn->prepare("DELETE FROM reset_links WHERE uid = (SELECT id FROM users WHERE email = ?)");
    $deleteStmt->bind_param("s", $email);
    $deleteStmt->execute();

    // Insert new reset token
    $insertStmt = $conn->prepare("INSERT INTO reset_links (uid, code, timestamp) VALUES ((SELECT id FROM users WHERE email = ?), ?, NOW())");
    $insertStmt->bind_param("ss", $email, $token);
    $insertStmt->execute();

    return $insertStmt->affected_rows > 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if (!$email) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Email not found']);
        exit;
    }

    // Generate reset token
    $resetToken = generateResetToken();
    $resetLink = "$APP_URL/reset-password.php?token=" . $resetToken;

    // Create reset link entry in database
    if (createPasswordResetEntry($email, $resetToken)) {
        // Send reset email
        if (sendResetEmail($email, $resetLink)) {
            echo json_encode(['success' => true, 'message' => 'Reset link sent']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to send email']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - INFund</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>
    <div class="container">
        <!-- Left Side - Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <h2 class="hero-title">Decentralized crowdfunding for universities</h2>
                <img src="./assets/images/static/hero.png" alt="INFund" class="hero-image">
            </div>
        </div>

        <!-- Right Side - Forgot Password Form -->
        <div class="form-section">
            <div class="form-container">
                <div class="logo-container">
                    <div class="logo-circle">
                        <img src="./assets/images/static/logo.png" alt="INFund Logo" class="logo">
                    </div>
                </div>
                <h1 class="welcome-text">Reset Password</h1>
                <p class="subtitle">Enter your email to receive reset instructions</p>

                <form id="forgotPasswordForm" class="forgot-password-form">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" id="email" name="email" class="form-input" required>
                        <span class="error-message" id="emailError"></span>
                    </div>

                    <button type="submit" class="submit-button">
                        <span class="button-text">Send Reset Link</span>
                        <div class="spinner hidden"></div>
                    </button>

                    <div class="back-to-login">
                        <a href="./login.php" class="back-link">
                            <i class="fas fa-arrow-left"></i>
                            Back to Login
                        </a>
                    </div>
                </form>

                <!-- Success Message (Initially Hidden) -->
                <div id="successMessage" class="hidden success-message hidden">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Check Your Email</h3>
                    <p>We've sent password reset instructions to your email address.</p>
                    <p class="email-note">Don't see it? Check your spam folder.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#forgotPasswordForm').on('submit', function(e) {
                e.preventDefault();

                // Reset previous error messages
                $('.error-message').text('');

                const email = $('#email').val();
                const submitButton = $('.submit-button');
                const spinner = $('.spinner');

                // Disable submit and show spinner
                submitButton.prop('disabled', true);
                spinner.removeClass('hidden');
                $('.button-text').hide();

                // AJAX call to send reset link
                $.ajax({
                    url: './forgot-password',
                    method: 'POST',
                    data: {
                        email: email
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Hide form, show success message
                            $('.forgot-password-form').hide();
                            $('#successMessage').removeClass('hidden');
                            toastr.success(response.message, 'Success');
                        } else {
                            toastr.error(response.message, 'Error');
                            $('#emailError').text(response.message);
                        }
                    },
                    error: function() {
                        toastr.error('An unexpected error occurred', 'Error');
                    },
                    complete: function() {
                        submitButton.prop('disabled', false);
                        spinner.addClass('hidden');
                        $('.button-text').show();
                    }
                });
            });
        });
    </script>
</body>

</html>