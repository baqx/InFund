<?php
// api/get_student.php
session_start();
require_once '../../config/config.php';

if (!isset($_SESSION['university_id']) || !isset($_GET['id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized or invalid request']);
    exit();
}

$university = $_SESSION['university_abbreviation'];
$id = $_GET['id'];

$query = "SELECT * FROM users WHERE id = ? AND university = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "is", $id, $university);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    http_response_code(404);
    echo json_encode(['error' => 'Student not found']);
    exit();
}

echo json_encode($student);
mysqli_stmt_close($stmt);
?>
