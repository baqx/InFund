<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - INFund</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="./assets/css/signup.css">
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

        <!-- Right Side - Registration Form -->
        <div class="form-section">
            <div class="form-container registration">
                <div class="logo-container">
                    <div class="logo-circle">
                        <img src="./assets/images/static/logo.png" alt="INFund Logo" class="logo">
                    </div>
                </div>
                <h1 class="welcome-text">Create Account</h1>
                <p class="subtitle">Join our community today</p>

                <form id="registrationForm" action="register.php" method="POST" class="registration-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="username">Username*</label>
                            <input type="text" id="username" name="username" class="form-input" required>
                            <span class="error-message" id="usernameError"></span>
                        </div>

                        <div class="form-group">
                            <label for="fullname">Full Name*</label>
                            <input type="text" id="fullname" name="fullname" class="form-input" required>
                            <span class="error-message" id="fullnameError"></span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address*</label>
                            <input type="email" id="email" name="email" class="form-input" required>
                            <span class="error-message" id="emailError"></span>
                        </div>

                        <div class="form-group">
                            <label for="dob">Date of Birth*</label>
                            <input type="date" id="dob" name="dob" class="form-input" required>
                            <span class="error-message" id="dobError"></span>
                        </div>

                        <div class="form-group">
                            <label for="country">Country*</label>
                            <select id="country" name="country" class="form-input" required>
                                <option value="">Select Country</option>
                                <!-- Countries will be populated via JavaScript -->
                            </select>
                            <span class="error-message" id="countryError"></span>
                        </div>

                        <div class="form-group">
                            <label for="state">State*</label>
                            <select id="state" name="state" class="form-input" required>
                                <option value="">Select State</option>
                                <!-- States will be populated via JavaScript based on country -->
                            </select>
                            <span class="error-message" id="stateError"></span>
                        </div>

                        <div class="form-group">
                            <label for="university">University*</label>
                            <select id="university" name="university" class="form-input" required>
                                <option value="">Select University</option>
                                <!-- Universities will be populated via JavaScript -->
                            </select>
                            <span class="error-message" id="universityError"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="faculty">Faculty/College*</label>
                            <select id="faculty" name="faculty" class="form-input" required>
                                <option value="">Select Faculty/College</option>
                                <!-- Faculties/Colleges will be populated via JavaScript -->
                            </select>
                            <span class="error-message" id="facultyError"></span>
                        </div>

                        <div class="form-group">
                            <label for="department">Department*</label>
                            <select id="department" name="department" class="form-input" required>
                                <option value="">Select Department</option>
                                <!-- Departments will be populated via JavaScript -->
                            </select>
                            <span class="error-message" id="department Error"></span>
                        </div>

                        <div class="form-group">
                            <label for="matricno">Matric Number*</label>
                            <input type="text" id="matricno" name="matricno" class="form-input" required>
                            <span class="error-message" id="matricnoError"></span>
                        </div>

                        <div class="form-group">
                            <label for="password">Password*</label>
                            <div class="password-input-container">
                                <input type="password" id="password" name="password" class="form-input" required>
                                <button type="button" class="toggle-password">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                            <span class="error-message" id="passwordError"></span>
                        </div>

                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password*</label>
                            <div class="password-input-container">
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-input" required>
                                <button type="button" class="toggle-password">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                            <span class="error-message" id="confirmPasswordError"></span>
                        </div>
                    </div>

                    <div class="form-group terms-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="terms" required>
                            <span class="checkmark"></span>
                            I agree to the <a href="./terms">Terms of Service</a> and <a href="./privacy">Privacy Policy</a>
                        </label>
                        <span class="error-message" id="termsError"></span>
                    </div>

                    <button type="submit" class="submit-button">Create Account</button>

                    <!--  <div class="social-login">
                        <button type="button" class="google-login">
                            <img src="google-icon.png" alt="Google">
                            Or sign up with Google
                        </button>
                    </div> -->

                    <p class="login-prompt">
                        Already have an account?
                        <a href="./login">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script src="countries.js"></script>
    <script src="./assets/js/auth_pages/signup.js"></script>
</body>

</html>