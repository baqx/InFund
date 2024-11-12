<?php
session_start();
include '../../config/config.php';
include '../get_universities.php';
include './profile_functions.php';


$user_id = $_SESSION['user_id'];
$bank_list = getBanks();
$levels = range(100, 900, 100);

// Get user's current data
$user_data = getUserData($user_id);

// Handle form submission via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $response = array('success' => false, 'message' => '');

    // Validate unique fields
    if (!isFieldUnique('username', $_POST['username'], $user_id)) {
        $response['message'] = 'Username already exists!';
        echo json_encode($response);
        exit;
    }
    if (!isFieldUnique('email', $_POST['email'], $user_id)) {
        $response['message'] = 'Email already exists!';
        echo json_encode($response);
        exit;
    }
    if (!isFieldUnique('phone', $_POST['phone'], $user_id)) {
        $response['message'] = 'Phone number already exists!';
        echo json_encode($response);
        exit;
    }

    // Update profile
    $result = updateUserProfile($user_id, $_POST);

    if ($result) {
        $response['success'] = true;
        $response['message'] = 'Profile updated successfully!';
    } else {
        $response['message'] = 'Error updating profile!';
    }

    echo json_encode($response);
    exit;
}
