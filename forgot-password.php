<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - INFund</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

                <form id="forgotPasswordForm" action="forgot-password.php" method="POST" class="forgot-password-form">
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
                <div id="successMessage" class="success-message hidden">
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
    <script src="forgot-password.js"></script>
</body>
</html>