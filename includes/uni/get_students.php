<?php
session_start();
require_once '../../config/config.php';
include './functions.php';
header('Content-Type: application/json');



if (!isset($_SESSION['university_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$universitydets = getUniversityDetails($_SESSION['university_id']);
$university = $universitydets["abbreviation"];

$page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$sort = isset($_GET['sort']) && in_array($_GET['sort'], ['fullname', 'matric_no', 'faculty', 'department', 'level', 'email']) 
        ? $_GET['sort'] 
        : 'fullname';
$direction = isset($_GET['direction']) && strtoupper($_GET['direction']) === 'DESC' ? 'DESC' : 'ASC';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$faculty = isset($_GET['faculty']) ? $_GET['faculty'] : '';
$department = isset($_GET['department']) ? $_GET['department'] : '';
$level = isset($_GET['level']) ? $_GET['level'] : '';

// Build WHERE clause
$where = ["university = ?"];
$types = "s";
$params = [$university];

if ($search) {
    $where[] = "(fullname LIKE ? OR matric_no LIKE ? OR email LIKE ?)";
    $types .= "sss";
    $searchPattern = "%$search%";
    array_push($params, $searchPattern, $searchPattern, $searchPattern);
}

if ($faculty) {
    $where[] = "faculty = ?";
    $types .= "s";
    $params[] = $faculty;
}

if ($department) {
    $where[] = "department = ?";
    $types .= "s";
    $params[] = $department;
}

if ($level) {
    $where[] = "level = ?";
    $types .= "s";
    $params[] = $level;
}

$whereClause = implode(' AND ', $where);

// Get total count for pagination
$countQuery = "SELECT COUNT(*) as total FROM users WHERE $whereClause";
$stmt = mysqli_prepare($conn, $countQuery);
if (!$stmt) {
    die(json_encode(['error' => 'Error preparing query: ' . mysqli_error($conn)]));
}
mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$total = mysqli_fetch_assoc($result)['total'];
$totalPages = ceil($total / $limit);
mysqli_stmt_close($stmt);

// Get students
$query = "SELECT id, fullname, matric_no, faculty, department, level, email 
          FROM users 
          WHERE $whereClause 
          ORDER BY $sort $direction 
          LIMIT ? OFFSET ?";
$types .= "ii";
$params[] = $limit;
$params[] = $offset;

$stmt = mysqli_prepare($conn, $query);
if (!$stmt) {
    die(json_encode(['error' => 'Error preparing query: ' . mysqli_error($conn)]));
}
mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$students = [];
while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}

echo json_encode([
    'students' => $students,
    'totalPages' => $totalPages,
]);

mysqli_stmt_close($stmt);
?>
