<?php
// signup_handler.php
session_start();
require_once '../config/config.php';
require_once '../config/secrets.php';
require_once '../vendor/autoload.php';
include './signup_functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = ['success' => false, 'message' => ''];
    
    // Get and sanitize form data
    $fields = [
        'username', 'fullname', 'email', 'phone', 'gender',
        'dob', 'country', 'state', 'university', 'faculty',
        'department', 'matricno', 'password', 'confirmPassword'
    ];
    
    $data = [];
    foreach ($fields as $field) {
        $data[$field] = mysqli_real_escape_string($conn, $_POST[$field] ?? '');
    }

    // Validation
    $error = '';

    // Check if username exists
    $check_username = mysqli_query($conn, "SELECT username FROM users WHERE username = '{$data['username']}'");
    if (mysqli_num_rows($check_username) > 0) {
        $error = "Username already exists";
    }

    // Check if email exists
    if (!$error) {
        $check_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$data['email']}'");
        if (mysqli_num_rows($check_email) > 0) {
            $error = "Email already exists";
        }
    }

    // Check if phone exists
    if (!$error) {
        $check_phone = mysqli_query($conn, "SELECT phone FROM users WHERE phone = '{$data['phone']}'");
        if (mysqli_num_rows($check_phone) > 0) {
            $error = "Phone number already exists";
        }
    }

    // Validate password match
    if (!$error && $data['password'] !== $data['confirmPassword']) {
        $error = "Passwords do not match";
    }

    // Process registration if no errors
    if (!$error) {
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $query = "INSERT INTO users (
            username, fullname, email, phone, gender,
            dob, country, state, university, faculty,
            department, matric_no, password
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssssssssss",
            $data['username'], $data['fullname'], $data['email'], 
            $data['phone'], $data['gender'], $data['dob'], 
            $data['country'], $data['state'], $data['university'], 
            $data['faculty'], $data['department'], $data['matricno'], 
            $hashed_password
        );

        if (mysqli_stmt_execute($stmt)) {
            $sendwlcmemail = sendWelcomeEmail($data['email'], $data['fullname']);
            
            if ($sendwlcmemail) {
                $response['success'] = true;
                $response['message'] = "Registration successful! Please login.";
            } else {
                $response['message'] = "Registration completed but welcome email failed to send.";
            }
        } else {
            $response['message'] = "Registration failed. Please try again.";
        }
    } else {
        $response['message'] = $error;
    }
    
    echo json_encode($response);
    exit;
}
?>