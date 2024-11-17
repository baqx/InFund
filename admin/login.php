<?php
session_start();
require_once '../config/config.php';

if (isset($_SESSION['admin_id'])) {
    header("Location: ./dashboard");
    exit;
}

// Fetch universities for dropdown
$universities_query = "SELECT id, name, abbreviation FROM universities ORDER BY name ASC";
$universities_result = $conn->query($universities_query);
$universities = [];
if ($universities_result->num_rows > 0) {
    while($row = $universities_result->fetch_assoc()) {
        $universities[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFund - Admin Login</title>
    <link rel="icon" href="../assets/icons/favicon.ico">
    <link rel="stylesheet" href="../assets/css/admin/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
    <div class="page-wrapper">
        <div class="login-container">
            <div class="login-header">
                <div class="logo-container">
                    <img src="../assets/images/static/logo.png" alt="Logo" class="logo">
                </div>
                <h1>Administrator Login</h1>
                <p>Access your administrative dashboard</p>
            </div>

            <form id="loginForm" action="../includes/admin/login_auth" method="POST" class="login-form">
                <div class="form-group">
                    <label for="university">University</label>
                    <select name="university_id" id="university" required>
                        <option value="">Select University</option>
                        <?php foreach($universities as $university): ?>
                            <option value="<?php echo htmlspecialchars($university['id']); ?>">
                                <?php echo htmlspecialchars($university['name']) . ' (' . htmlspecialchars($university['abbreviation']) . ')'; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-input">
                        <input type="password" id="password" name="password" required placeholder="Enter your password">
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Sign In</button>
            </form>

            <div class="login-footer">
                <p>Not an administrator? <a href="../uni/login.php">University Login</a></p>
            </div>
        </div>

        <div class="background-design"></div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.querySelector('.toggle-password i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.classList.remove('fa-eye');
                toggleBtn.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleBtn.classList.remove('fa-eye-slash');
                toggleBtn.classList.add('fa-eye');
            }
        }

        // Initialize toastr options
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };

        <?php if (isset($_GET['error'])): ?>
            toastr.error("<?php echo htmlspecialchars($_GET['error']); ?>");
        <?php endif; ?>
    </script>
</body>
</html>