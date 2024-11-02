<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - INFund</title>
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

        <!-- Right Side - Login Form -->
        <div class="form-section">
            <div class="form-container">
                <div class="logo-container">
                    <div class="logo-circle">
                    <img src="./assets/images/static/logo.png" alt="INFund Logo" class="logo">
                    </div>
                </div>
                <h1 class="welcome-text">INFund</h1>
                <p class="subtitle">Nice to see you again</p>

                <form id="loginForm" action="login.php" method="POST" class="login-form">
                    <div class="form-group">
                        <label for="email">Email or phone number</label>
                        <input type="text" id="email" name="email" class="form-input">
                        <span class="error-message" id="emailError"></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-input-container">
                            <input type="password" id="password" name="password" class="form-input">
                            <button type="button" class="toggle-password">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <span class="error-message" id="passwordError"></span>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            <span class="checkmark"></span>
                            Remember me
                        </label>
                        <a href="./forgot-password" class="forgot-password">Forgot password?</a>
                    </div>

                    <button type="submit" class="submit-button">Sign in</button>

                 

                    <p class="signup-prompt">
                        Don't have an account? 
                        <a href="./signup">Sign up now</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script src="./assets/js/auth_pages/login.js"></script>
</body>
</html>