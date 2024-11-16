
<?php
// api/get_departments.php
session_start();
require_once '../../config/config.php';

if (!isset($_SESSION['university_id']) || !isset($_GET['faculty_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized or invalid request']);
    exit();
}

$university_id = $_SESSION['university_id'];
$faculty_id = $_GET['faculty_id'];

$query = "SELECT id, name FROM university_departments 
          WHERE university_id = ? AND faculty_id = ? 
          ORDER BY name";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ii", $university_id, $faculty_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$departments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $departments[] = $row;
}

echo json_encode(['departments' => $departments]);
mysqli_stmt_close($stmt);
?>