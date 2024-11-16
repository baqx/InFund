<?php
session_start();
require '../../config/config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $abbreviation = $_POST['abbreviation'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $secret_code = $_POST['secret_code'];

    $error_message = "Invalid login credentials.";

    if (empty($abbreviation) || empty($email) || empty($password) || empty($secret_code)) {
        header("Location: index.php?error=" . urlencode("All fields are required."));
        exit;
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT id FROM universities 
                            WHERE abbreviation = ? 
                              AND email = ? 
                              AND password = ? 
                              AND secret_code = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $abbreviation, $email, $password, $secret_code);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Store the university ID in the session
        $_SESSION['university_id'] = $row['id'];
        $_SESSION['university_abbreviation'] = $row['abbreviation'];
        // Redirect to dashboard or another page
        header("Location: ../../uni/dashboard.php");
        exit;
    } else {
        header("Location: ../../uni/login.php?error=" . urlencode($error_message));
        exit;
    }

    // Close the statement
    $stmt->close();
} else {
    header("Location: ../../uni/index.php");
    exit;
}
