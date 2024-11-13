<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['email'])) {
    // Redirect to home page if user is already logged
    header("Location: ./dashboard/overview");
}
include('./config/config.php');
require_once './includes/login_handler.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - INFund</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="icon" href="./assets/icons/favicon.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <!-- Left Side - Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <h2 class="hero-title">Your next door crowdfunding solutions for universities</h2>
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

                <form id="loginForm" action="" method="POST" class="login-form">
                    <div class="form-group">
                        <label for="email">Email or phone number</label>
                        <input type="text" id="email" name="email" class="form-input" value="<?php echo htmlspecialchars($email ?? ''); ?>">
                        <span class="error-message"><?php echo $emailError; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-input-container">
                            <input type="password" id="password" name="password" class="form-input">
                            <button type="button" class="toggle-password">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <span class="error-message"><?php echo $passwordError; ?></span>
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

                <!-- Display login error -->
                <?php if ($loginError) : ?>
                    <div class="login-error-message">
                        <?php echo $loginError; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="./assets/js/auth_pages/login.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options.progressBar = true;
    </script>
    <script>
        <?php if (isset($_SESSION['success_message'])) : ?>
            toastr.success("<?php echo $_SESSION['success_message']; ?>");
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
    </script>
    <script>
        <?php if ($successMessage) : ?>
            toastr.success("<?php echo $successMessage; ?>", "Success", {
                timeOut: 1, // Hide after 3 seconds
                onHidden: function() {
                    window.location.href = './dashboard/overview'; // Redirect to homepage after success
                }
            });
        <?php elseif ($loginError) : ?>
            toastr.error("<?php echo $loginError; ?>", "Login Failed");
        <?php endif; ?>
    </script>
</body>

</html>