<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - INFund</title>
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

        <!-- Right Side - Verification Status -->
        <div class="form-section">
            <div class="form-container">
                <div class="logo-container">
                    <div class="logo-circle">
                    <img src="./assets/images/static/logo.png" alt="INFund Logo" class="logo">
                    </div>
                </div>

                <!-- Loading State (Initially Shown) -->
                <div id="loadingState" class="verification-state">
                    <div class="spinner"></div>
                    <h2>Verifying your email...</h2>
                    <p>Please wait while we confirm your email address</p>
                </div>

                <!-- Success State (Initially Hidden) -->
                <div id="successState" class="verification-state hidden">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h2>Email Verified!</h2>
                    <p>Your email has been successfully verified.</p>
                    <button onclick="window.location.href='./user/home'" class="submit-button">
                        Continue to Login
                    </button>
                </div>

                <!-- Error State (Initially Hidden) -->
                <div id="errorState" class="verification-state hidden">
                    <div class="error-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <h2>Verification Failed</h2>
                    <p>The verification link may have expired or is invalid.</p>
                    <div class="error-actions">
                        <button onclick="resendVerification()" class="submit-button outline">
                            Resend Verification Email
                        </button>
                        <a href="index.html" class="back-link">
                            <i class="fas fa-arrow-left"></i>
                            Back to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="verify-email.js"></script>
</body>
</html>