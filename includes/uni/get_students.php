<?php
// api/get_students.php
session_start();
require_once '../../config/config.php';

if (!isset($_SESSION['university_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$university = $_SESSION['university_abbreviation'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'fullname';
$direction = isset($_GET['direction']) ? $_GET['direction'] : 'asc';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$faculty = isset($_GET['faculty']) ? $_GET['faculty'] : '';
$department = isset($_GET['department']) ? $_GET['department'] : '';
$level = isset($_GET['level']) ? $_GET['level'] : '';

// Build the WHERE clause
$where = ["university = ?"];
$types = "s"; // for university
$params = [$university];

if ($search) {
    $where[] = "(fullname LIKE ? OR matric_no LIKE ? OR email LIKE ?)";
    $types .= "sss";
    $searchPattern = "%$search%";
    $params[] = $searchPattern;
    $params[] = $searchPattern;
    $params[] = $searchPattern;
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

// Allowed sort columns to prevent SQL injection
$allowedSort = ['fullname', 'matric_no', 'faculty', 'department', 'level', 'email'];
if (!in_array($sort, $allowedSort)) {
    $sort = 'fullname';
}
$direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';

// Get total count for pagination
$countQuery = "SELECT COUNT(*) as total FROM users WHERE $whereClause";
$stmt = mysqli_prepare($conn, $countQuery);
mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$total = mysqli_fetch_assoc($result)['total'];
$totalPages = ceil($total / $limit);

// Get students
$query = "SELECT id, fullname, matric_no, faculty, department, level, email 
          FROM users 
          WHERE $whereClause 
          ORDER BY $sort $direction 
          LIMIT ? OFFSET ?";
$types .= "ii"; // for limit and offset
$params[] = $limit;
$params[] = $offset;

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$students = [];
while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}

echo json_encode([
    'students' => $students,
    'totalPages' => $totalPages
]);
mysqli_stmt_close($stmt);
?>