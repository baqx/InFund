<?php
// Define error messages
$emailError = '';
$passwordError = '';
$loginError = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize it
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the form fields
    if (empty($email)) {
        $emailError = 'Please enter your email or phone number.';
    }

    if (empty($password)) {
        $passwordError = 'Please enter your password.';
    }

    if (empty($emailError) && empty($passwordError)) {
        // Call the function to authenticate user
        $successMessage = authenticateUser($email, $password, $conn);
    }
}

// Function to authenticate the user
function authenticateUser($email, $password, $conn)
{
    global $loginError; // To show login error message in case of failure
    global $successMessage;

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param('ss', $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // Update last login time
            $stmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $stmt->bind_param('i', $user['id']);
            $stmt->execute();

            // Success message for Toastr
            $successMessage = "Login successful!";
            return $successMessage;
        } else {
            $loginError = 'Invalid password.';
        }
    } else {
        $loginError = 'No user found with this email or username.';
    }

    return '';
}
