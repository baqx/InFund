<?php
require_once '../config/config.php';
require_once '../includes/signup_functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

try {
    // Sanitize and validate inputs
    $username = sanitizeInput($_POST['username']);
    $fullname = sanitizeInput($_POST['fullname']);
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $dob = sanitizeInput($_POST['dob']);
    $country = sanitizeInput($_POST['country']);
    $state = sanitizeInput($_POST['state']);
    $university = sanitizeInput($_POST['university']);
    $faculty = sanitizeInput($_POST['faculty']);
    $department = sanitizeInput($_POST['department']);
    $matric_no = sanitizeInput($_POST['matricno']);
    $gender = sanitizeInput($_POST['gender']);
    $phone = sanitizeInput($_POST['phone']);

    $errors = [];

    // Validation
    if (!$username || strlen($username) < 3 || strlen($username) > 20) {
        $errors['username'] = 'Username must be between 3 and 20 characters';
    }
    if (isUsernameTaken($username)) {
        $errors['username'] = 'Username is already taken';
    }
    if (!validateEmail($email)) {
        $errors['email'] = 'Invalid email address';
    }
    if (isEmailTaken($email)) {
        $errors['email'] = 'Email is already registered';
    }
    if (!validatePassword($password)) {
        $errors['password'] = 'Password must be at least 8 characters and contain uppercase, lowercase, and numbers';
    }
    if ($password !== $confirmPassword) {
        $errors['confirmPassword'] = 'Passwords do not match';
    }
    if (isMatricNoTaken($matric_no)) {
        $errors['matricno'] = 'Matric number is already registered';
    }

    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'errors' => $errors]);
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement
    $stmt = $conn->prepare("
        INSERT INTO users (username, fullname, email, password, dob, country, state, 
                         university, faculty, department, matric_no, gender, phone)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssssssssssss",
        $username,
        $fullname,
        $email,
        $hashedPassword,
        $dob,
        $country,
        $state,
        $university,
        $faculty,
        $department,
        $matric_no,
        $gender,
        $phone
    );

    if ($stmt->execute()) {
        // Send welcome email
        $emailSent = sendWelcomeEmail($email, $fullname);

        echo json_encode([
            'status' => 'success',
            'message' => 'Registration successful!',
            'emailSent' => $emailSent
        ]);
    } else {
        throw new Exception("Registration failed");
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'An error occurred during registration'
    ]);
}
