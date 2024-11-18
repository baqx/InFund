<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['email'])) {
    // Redirect to home page if user is already logged
    header("Location: ./dashboard/overview");
}
if (isset($_SESSION['form_errors'])) {
    $errors = $_SESSION['form_errors'];
    unset($_SESSION['form_errors']);
}

// Repopulate form data if available
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['form_data']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - INFund</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="./assets/css/signup.css">
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

                <form id="registrationForm" action="./includes/signup_handler" method="POST" class="registration-form">

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
                            <label for="gender">Gender*</label>
                            <select id="gender" name="gender" class="form-input" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                                <option value="prefer_not_to_say">Prefer not to say</option>
                            </select>
                            <span class="error-message" id="genderError"></span>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number*</label>
                            <input type="tel" id="phone" name="phone" class="form-input" required>
                            <span class="error-message" id="phoneError"></span>
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
                                <option value="Nigeria">Nigeria</option>
                            </select>
                            <span class="error-message" id="countryError"></span>
                        </div>

                        <div class="form-group">
                            <label for="state">State*</label>
                            <select id="state" name="state" class="form-input" required>
                                <option value="">Select State</option>
                                <option value="Ogun">Ogun</option>
                            </select>
                            <span class="error-message" id="stateError"></span>
                        </div>

                        <div class="form-group">
                            <label for="university">University*</label>
                            <select id="university" name="university" class="form-input" required>
                                <option value="">Select University</option>

                            </select>
                            <span class="error-message" id="universityError"></span>
                        </div>

                        <div class="form-group">
                            <label for="faculty">Faculty/College*</label>
                            <select id="faculty" name="faculty" class="form-input" required>
                                <option value="">Select Faculty/College</option>

                            </select>
                            <span class="error-message" id="facultyError"></span>
                        </div>

                        <div class="form-group">
                            <label for="department">Department/Course *</label>
                            <select id="department" name="department" class="form-input" required>
                                <option value="">Select Department</option>

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

                    <input type="submit" class="submit-button" value="Create Account">

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // signup.js
        $(document).ready(function() {
            // Load universities on page load
            $.getJSON('includes/get_unis', function(data) {
                let options = '<option value="">Select University</option>';
                data.forEach(function(university) {
                    options += `<option value="${university.abbreviation}">${university.name}</option>`;
                });
                $('#university').html(options);
            });

            // Load faculties when university is selected
            $('#university').change(function() {
                const university = $(this).val();
                if (university) {
                    $.getJSON('includes/get_faculties', {
                        university: university
                    }, function(data) {
                        let options = '<option value="">Select Faculty</option>';
                        data.forEach(function(faculty) {
                            options += `<option value="${faculty.id}">${faculty.name}</option>`;
                        });
                        $('#faculty').html(options);
                        $('#department').html('<option value="">Select Department</option>');
                    });
                } else {
                    $('#faculty').html('<option value="">Select Faculty</option>');
                    $('#department').html('<option value="">Select Department</option>');
                }
            });

            // Load departments when faculty is selected
            $('#faculty').change(function() {
                const university = $('#university').val();
                const faculty = $(this).val();
                if (university && faculty) {
                    $.getJSON('includes/get_departments', {
                            university: university,
                            faculty: faculty
                        },
                        function(data) {
                            let options = '<option value="">Select Department</option>';
                            data.forEach(function(department) {
                                options += `<option value="${department.name}">${department.name}</option>`;
                            });
                            $('#department').html(options);
                        }
                    );
                } else {
                    $('#department').html('<option value="">Select Department</option>');
                }
            });

            // Form validation and submission
            $('#registrationForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: './includes/signup_handler',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            setTimeout(function() {
                                window.location.href = './login';
                            }, 2000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function() {
                        toastr.error('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

</body>

</html>