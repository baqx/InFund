<?php
session_start();
include '../../config/config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    die(json_encode(['success' => false, 'message' => 'User not authenticated']));
}

// Validate form data
$errors = [];

// Required fields validation
$required_fields = ['title', 'description', 'goalAmount', 'startDate', 'endDate'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $errors[] = ucfirst($field) . " is required";
    }
}

// Word count validation for impact and importance
if (!empty($_POST['impact']) && strlen($_POST['impact']) < 250) {
    $errors[] = "Impact must be at least 250 words";
}

if (!empty($_POST['importance']) && strlen($_POST['importance']) < 250) {
    $errors[] = "Importance must be at least 250 words";
}

// Date validation
$start_date = strtotime($_POST['startDate']);
$end_date = strtotime($_POST['endDate']);
$today = strtotime(date('Y-m-d'));

if ($start_date < $today) {
    $errors[] = "Start date cannot be in the past";
}

if ($end_date <= $start_date) {
    $errors[] = "End date must be after start date";
}

// Goal amount validation
if (!is_numeric($_POST['goalAmount']) || $_POST['goalAmount'] < 1000) {
    $errors[] = "Goal amount must be at least ₦1,000";
}

// Image validation and upload function
function handleImageUpload($file, $index)
{
    if (empty($file['name'])) {
        return $index === 1 ? false : null;
    }

    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowed_types)) {
        return false;
    }

    $max_size = 5 * 1024 * 1024; // 5MB
    if ($file['size'] > $max_size) {
        return false;
    }

    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_filename = uniqid('campaign_' . time() . '_') . '.' . $file_extension;
    $upload_path = '../../assets/images/campaigns/' . $new_filename;

    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        return $new_filename;
    }

    return false;
}

// Handle image uploads
$image1 = handleImageUpload($_FILES['image1'], 1);
if ($image1 === false) {
    $errors[] = "Primary image is required and must be a valid image file (JPG, PNG, or GIF) under 5MB";
}

$image2 = isset($_FILES['image2']) ? handleImageUpload($_FILES['image2'], 2) : null;
$image3 = isset($_FILES['image3']) ? handleImageUpload($_FILES['image3'], 3) : null;
$image4 = isset($_FILES['image4']) ? handleImageUpload($_FILES['image4'], 4) : null;

if (!empty($errors)) {
    die(json_encode(['success' => false, 'message' => implode("<br>", $errors)]));
}

// Prepare and execute SQL
$sql = "INSERT INTO campaigns (title, description, impact, importance, uid, goal_amount, 
        start_date, end_date, image1, image2, image3, image4) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssidssssss",
    $_POST['title'],
    $_POST['description'],
    $_POST['impact'],
    $_POST['importance'],
    $_SESSION['user_id'],
    $_POST['goalAmount'],
    $_POST['startDate'],
    $_POST['endDate'],
    $image1,
    $image2,
    $image3,
    $image4
);

if ($stmt->execute()) {
    $campaign_id = $conn->insert_id;
    echo json_encode([
        'success' => true,
        'message' => 'Campaign created successfully!',
        'campaign_id' => $campaign_id
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error creating campaign: ' . $conn->error
    ]);
}

$stmt->close();
$conn->close();
