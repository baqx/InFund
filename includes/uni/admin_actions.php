<?php
// admin_actions.php
session_start();
require_once '../../config/config.php';

// Check if user is logged in
if (!isset($_SESSION['university_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

$university_id = $_SESSION['university_id'];
$university_abbreviation= $_SESSION['university_abbreviation'];


// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';
    
    switch ($action) {
        case 'get_faculties':
            getFaculties($university_id);
            break;
            
        case 'get_departments':
            if (isset($_GET['faculty_id'])) {
                getDepartments($_GET['faculty_id']);
            }
            break;
            
        case 'list':
            listAdministrators($university_id);
            break;
            
        case 'get_admin':
            if (isset($_GET['admin_id'])) {
                getAdministrator($_GET['admin_id'], $university_id);
            }
            break;
    }
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'add':
            addAdministrator($university_id);
            break;
            
        case 'update':
            updateAdministrator($university_id);
            break;
            
        case 'delete':
            deleteAdministrator($university_id);
            break;
    }
}

function getFaculties($university_id) {
    global $conn;
    
    $stmt = $conn->prepare("
        SELECT id, name 
        FROM university_faculties 
        WHERE university_id = ?
        ORDER BY name ASC
    ");
    
    $stmt->bind_param("i", $university_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $faculties = [];
    while ($row = $result->fetch_assoc()) {
        $faculties[] = $row;
    }
    
    echo json_encode(['success' => true, 'faculties' => $faculties]);
}

function getDepartments($faculty_id) {
    global $conn;
    
    $stmt = $conn->prepare("
        SELECT id, name 
        FROM university_departments 
        WHERE faculty_id = ?
        ORDER BY name ASC
    ");
    
    $stmt->bind_param("i", $faculty_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $departments = [];
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }
    
    echo json_encode(['success' => true, 'departments' => $departments]);
}

function listAdministrators($university_id) {
    global $conn;
    
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 10; // Items per page
    $offset = ($page - 1) * $limit;
    
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'created_at';
    $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
    
    // Whitelist allowed sort columns to prevent SQL injection
    $allowed_sorts = ['fullname', 'email', 'phone', 'balance', 'created_at'];
    if (!in_array($sort, $allowed_sorts)) {
        $sort = 'created_at';
    }
    
    // Ensure order is either ASC or DESC
    $order = ($order === 'ASC') ? 'ASC' : 'DESC';
    
    // Get total count for pagination
    $stmt = $conn->prepare("
        SELECT COUNT(*) as total 
        FROM creators 
        WHERE university_id = ?
    ");
    $stmt->bind_param("i", $university_id);
    $stmt->execute();
    $total = $stmt->get_result()->fetch_assoc()['total'];
    
    // Get administrators with faculty and department names
    $stmt = $conn->prepare("
        SELECT c.*, 
               f.name as faculty_name,
               d.name as department_name
        FROM creators c
        LEFT JOIN university_faculties f ON c.faculty_id = f.id
        LEFT JOIN university_departments d ON c.department_id = d.id
        WHERE c.university_id = ?
        ORDER BY $sort $order
        LIMIT ? OFFSET ?
    ");
    
    $stmt->bind_param("iii", $university_id, $limit, $offset);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    $administrators = [];
    while ($row = $result->fetch_assoc()) {
        // Remove sensitive information
        unset($row['password']);
        $administrators[] = $row;
    }
    
    $total_pages = ceil($total / $limit);
    
    echo json_encode([
        'success' => true,
        'administrators' => $administrators,
        'total_pages' => $total_pages,
        'current_page' => $page
    ]);
}

function addAdministrator($university_id) {
    global $conn;
    
    // Validate required fields
    $required_fields = ['fullname', 'email', 'phone', 'faculty_id', 'department_id', 'password', 'balance'];
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            echo json_encode(['success' => false, 'message' => "Missing required field: $field"]);
            return;
        }
    }
    
    // Check if email already exists
    $stmt = $conn->prepare("
        SELECT id FROM creators 
        WHERE email = ? AND university_id = ?
    ");
    $stmt->bind_param("si", $_POST['email'], $university_id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already exists']);
        return;
    }
    
    // Hash password
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Insert new administrator
    $stmt = $conn->prepare("
        INSERT INTO creators (
            university_id, fullname, email, phone, 
            faculty_id, department_id, password, balance
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    $stmt->bind_param(
        "isssiisd",
        $university_id,
        $_POST['fullname'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['faculty_id'],
        $_POST['department_id'],
        $password_hash,
        $_POST['balance']
    );
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding administrator']);
    }
}

function updateAdministrator($university_id) {
    global $conn;
    
    if (!isset($_POST['admin_id'])) {
        echo json_encode(['success' => false, 'message' => 'Administrator ID required']);
        return;
    }
    
    // Verify administrator belongs to university
    $stmt = $conn->prepare("
        SELECT id FROM creators 
        WHERE id = ? AND university_id = ?
    ");
    $stmt->bind_param("ii", $_POST['admin_id'], $university_id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Administrator not found']);
        return;
    }
    
    // Check email uniqueness (excluding current admin)
    $stmt = $conn->prepare("
        SELECT id FROM creators 
        WHERE email = ? AND university_id = ? AND id != ?
    ");
    $stmt->bind_param("sii", $_POST['email'], $university_id, $_POST['admin_id']);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already exists']);
        return;
    }
    
    // Prepare update query
    $query = "
        UPDATE creators 
        SET fullname = ?, 
            email = ?, 
            phone = ?,
            faculty_id = ?,
            department_id = ?,
            balance = ?
    ";
    $params = [
        $_POST['fullname'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['faculty_id'],
        $_POST['department_id'],
        $_POST['balance']
    ];
    $types = "sssiid";
    
    // Add password update if provided
    if (!empty($_POST['new_password'])) {
        $password_hash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $query .= ", password = ?";
        $params[] = $password_hash;
        $types .= "s";
    }
    
    $query .= " WHERE id = ? AND university_id = ?";
    $params[] = $_POST['admin_id'];
    $params[] = $university_id;
    $types .= "ii";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating administrator']);
    }
}

function getAdministrator($admin_id, $university_id) {
    global $conn;
    
    $stmt = $conn->prepare("
        SELECT id, fullname, email, phone, faculty_id, 
               department_id, balance 
        FROM creators 
        WHERE id = ? AND university_id = ?
    ");
    
    $stmt->bind_param("ii", $admin_id, $university_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($admin = $result->fetch_assoc()) {
        echo json_encode(['success' => true, 'administrator' => $admin]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Administrator not found']);
    }
}

function deleteAdministrator($university_id) {
    global $conn;
    
    if (!isset($_POST['admin_id'])) {
        echo json_encode(['success' => false, 'message' => 'Administrator ID required']);
        return;
    }
    
    $stmt = $conn->prepare("
        DELETE FROM creators 
        WHERE id = ? AND university_id = ?
    ");
    
    $stmt->bind_param("ii", $_POST['admin_id'], $university_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting administrator']);
    }
}