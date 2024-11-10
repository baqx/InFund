<?php
// signup_handler.php
session_start();
require_once '../config/config.php';
require_once '../config/secrets.php';
require_once '../vendor/autoload.php';
include './signup_functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $university = mysqli_real_escape_string($conn, $_POST['university']);
    $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $matric_no = mysqli_real_escape_string($conn, $_POST['matricno']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    // Validation
    $errors = [];

    // Check if username exists
    $check_username = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check_username) > 0) {
        $errors['username'] = "Username already exists";
    }

    // Check if email exists
    $check_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        $errors['email'] = "Email already exists";
    }

    // Check if phone exists
    $check_phone = mysqli_query($conn, "SELECT phone FROM users WHERE phone = '$phone'");
    if (mysqli_num_rows($check_phone) > 0) {
        $errors['phone'] = "Phone number already exists";
    }

    // Validate password match
    if ($password !== $confirm_password) {
        $errors['password'] = "Passwords do not match";
    }

    // If there are no errors, proceed with registration
    if (empty($errors)) {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data
        $query = "INSERT INTO users (username, fullname, email, phone, gender, dob, country, state, university, faculty, department, matric_no, password) 
                  VALUES ('$username', '$fullname', '$email', '$phone', '$gender', '$dob', '$country', '$state', '$university', '$faculty', '$department', '$matric_no', '$hashed_password')";

        if (mysqli_query($conn, $query)) {
            $sendwlcmemail = sendWelcomeEmail($email, $fullname);

            if ($sendwlcmemail) {
                $_SESSION['success_message'] = "Registration successful! Please login.";
                header("Location: ../login");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Registration failed. Please try again.";
            header("Location: ../signup");
            exit();
        }
    } else {
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_data'] = $_POST; // Save form data for repopulating
        header("Location: ../signup.php");
        exit();
    }
}
