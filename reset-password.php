<?php
session_start();
require './config/config.php';

// Check if token is present
if (!isset($_GET['token'])) {
    die("Invalid reset link");
}

$token = $_GET['token'];

// Validate token and check expiration
$stmt = $conn->prepare("
    SELECT u.id, u.email, r.code, r.timestamp 
    FROM reset_links r 
    JOIN users u ON r.uid = u.id 
    WHERE r.code = ? AND r.link_opened = '0' AND r.timestamp > DATE_SUB(NOW(), INTERVAL 12 HOUR)
");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Invalid or expired reset link");
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - INFund</title>
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
        <div class="form-section">
            <div class="form-container">
                <div class="logo-container">
                    <div class="logo-circle">
                        <img src="./assets/images/static/logo.png" alt="INFund Logo" class="logo">
                    </div>
                </div>
                <h1 class="welcome-text">Reset Password</h1>

                <form id="resetPasswordForm" class="reset-password-form">
                    <input type="hidden" id="token" name="token" value="<?php echo htmlspecialchars($token); ?>">

                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" name="new-password" class="form-input" required>
                        <span class="error-message" id="passwordError"></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" class="form-input" required>
                        <span class="error-message" id="confirmPasswordError"></span>
                    </div>

                    <button type="submit" class="submit-button">
                        <span class="button-text">Reset Password</span>
                        <div class="spinner hidden"></div>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#resetPasswordForm').on('submit', function(e) {
                e.preventDefault();

                // Reset error messages
                $('.error-message').text('');

                const newPassword = $('#new-password').val();
                const confirmPassword = $('#confirm-password').val();
                const token = $('#token').val();

                // Basic validation
                if (newPassword.length < 8) {
                    $('#passwordError').text('Password must be at least 8 characters');
                    return;
                }

                if (newPassword !== confirmPassword) {
                    $('#confirmPasswordError').text('Passwords do not match');
                    return;
                }

                // Disable submit button and show spinner
                const submitButton = $('.submit-button');
                submitButton.prop('disabled', true);
                $('.spinner').removeClass('hidden');

                // AJAX call to reset password
                $.ajax({
                    url: './includes/process-reset-password',
                    method: 'POST',
                    data: {
                        token: token,
                        new_password: newPassword
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message, 'Success');
                            setTimeout(() => {
                                window.location.href = 'login.php';
                            }, 2000);
                        } else {
                            toastr.error(response.message, 'Error');
                        }
                    },
                    error: function() {
                        toastr.error('An unexpected error occurred', 'Error');
                    },
                    complete: function() {
                        submitButton.prop('disabled', false);
                        $('.spinner').addClass('hidden');
                    }
                });
            });
        });
    </script>

</body>

</html>