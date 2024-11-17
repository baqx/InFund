<?php
session_start();
require_once '../../config/config.php';
header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

try {
    // Validate required fields
    $required_fields = ['name', 'university', 'faculty', 'department', 'level', 'price', 'start_date', 'end_date'];
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            throw new Exception("$field is required");
        }
    }

    // Validate price
    if (!is_numeric($_POST['price']) || $_POST['price'] < 100) {
        throw new Exception('Price must be at least ₦100');
    }

    // Validate dates
    $start_date = new DateTime($_POST['start_date']);
    $end_date = new DateTime($_POST['end_date']);
    $today = new DateTime();

    if ($start_date < $today) {
        throw new Exception('Start date cannot be in the past');
    }

    if ($end_date < $start_date) {
        throw new Exception('End date must be after start date');
    }

    // Get university abbreviation from ID
    $uni_stmt = $conn->prepare("SELECT abbreviation FROM universities WHERE id = ?");
    $uni_stmt->bind_param('i', $_POST['university']);
    $uni_stmt->execute();
    $uni_result = $uni_stmt->get_result();
    $university = $uni_result->fetch_assoc()['abbreviation'];

    // Get faculty name
    $fac_stmt = $conn->prepare("SELECT name FROM university_faculties WHERE id = ?");
    $fac_stmt->bind_param('i', $_POST['faculty']);
    $fac_stmt->execute();
    $fac_result = $fac_stmt->get_result();
    $faculty = $fac_result->fetch_assoc()['name'];

    // Get department name
    $dept_stmt = $conn->prepare("SELECT name FROM university_departments WHERE id = ?");
    $dept_stmt->bind_param('i', $_POST['department']);
    $dept_stmt->execute();
    $dept_result = $dept_stmt->get_result();
    $department = $dept_result->fetch_assoc()['name'];

    // Insert bill
    $stmt = $conn->prepare("INSERT INTO bills (creator_id, name, university, faculty, department, level, price, start_date, end_date)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
   
    $stmt->bind_param('isssssiss',
        $_SESSION['admin_id'],
        $_POST['name'],
        $university,
        $faculty,
        $department,
        $_POST['level'],
        $_POST['price'],
        $_POST['start_date'],
        $_POST['end_date']
    );

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Bill created successfully']);
    } else {
        throw new Exception('Failed to create bill');
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>