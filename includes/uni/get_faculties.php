




<?php
// api/get_faculties.php
session_start();
require_once '../../config/config.php';

if (!isset($_SESSION['university_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$university_id = $_SESSION['university_id'];

$query = "SELECT id, name FROM university_faculties WHERE university_id = ? ORDER BY name";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $university_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$faculties = [];
while ($row = mysqli_fetch_assoc($result)) {
    $faculties[] = $row;
}

echo json_encode(['faculties' => $faculties]);
mysqli_stmt_close($stmt);
?>
