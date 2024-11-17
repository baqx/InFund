<?php
session_start();
require_once '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../admin/login.php");
    exit;
}

// Initialize variables and sanitize input
$university_id = filter_input(INPUT_POST, 'university_id', FILTER_SANITIZE_NUMBER_INT);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];

// Validation
$errors = [];

if (empty($university_id)) {
    $errors[] = "Please select a university.";
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
}

if (empty($password)) {
    $errors[] = "Password is required.";
}

if (!empty($errors)) {
    $error_message = implode(" ", $errors);
    header("Location: ../../admin/login.php?error=" . urlencode($error_message));
    exit;
}

try {
    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT id, password, fullname, role FROM creators 
                           WHERE email = ? AND university_id = ?");
    
    if (!$stmt) {
        throw new Exception("Database error: " . $conn->error);
    }

    // Bind parameters and execute
    $stmt->bind_param("si", $email, $university_id);
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_name'] = $user['fullname'];
            $_SESSION['admin_role'] = $user['role'];
            $_SESSION['university_id'] = $university_id;
            
            // Redirect to dashboard
            header("Location: ../../admin/dashboard.php");
            exit;
        } else {
            throw new Exception("Invalid email or password.");
        }
    } else {
        throw new Exception("Invalid email or password.");
    }

} catch (Exception $e) {
    header("Location: ../../admin/login.php?error=" . urlencode($e->getMessage()));
    exit;
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
}