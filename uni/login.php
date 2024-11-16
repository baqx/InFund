<?php
session_start();
if (isset($_SESSION['university_id'])) {
    // Redirect to home page if university is already logged
    header("Location: ./dashboard");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFund - University Login</title>
    <link rel="icon" href="../assets/icons/favicon.ico">
  
    <link rel="stylesheet" href="../assets/css/colors.css">
    <link rel="stylesheet" href="../assets/css/uni/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options.progressBar = true;
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user/nav.css">
</head>

<body>
    <div class="page-container">
        <section class="login-section">
            <div class="login-container">
                <form action="../includes/uni/login_auth" method="POST" class="login-form">
                    <h2>Welcome Back</h2>
                    <div class="form-group">
                        <label for="abbreviation">University Abbreviation</label>
                        <input type="text" id="abbreviation" name="abbreviation" required placeholder="e.g., UNN">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required placeholder="e.g., admin@university.edu">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required placeholder="Your password">
                    </div>
                    <div class="form-group">
                        <label for="secret_code">Secret Code</label>
                        <input type="text" id="secret_code" name="secret_code" required placeholder="Your secret code">
                    </div>
                    <button type="submit" class="btn">Sign In</button>
                </form>
                <?php if (isset($_GET['error'])) : ?>
                    <script>
                        console.log("Error message: ", "<?php echo htmlspecialchars($_GET['error']); ?>");
                        toastr.error("<?php echo htmlspecialchars($_GET['error']); ?>");
                    </script>
                <?php endif; ?>
            </div>
        </section>
        <section class="hero-section">
            <div class="hero-content">
                <img src="../assets/images/static/uni_hero.png" alt="University Campus" class="placeholder-img">
                <h1>Welcome to INFund University Portal</h1>
                <p>Access your administrative dashboard to manage university operations efficiently and securely.</p>
            </div>
        </section>
    </div>
</body>

</html>