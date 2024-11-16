
<?php
// api/delete_student.php
session_start();
require_once '../../config/config.php';

if (!isset($_SESSION['university_id']) || !isset($_POST['id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized or invalid request']);
    exit();
}

$university = $_SESSION['university_abbreviation'];
$id = $_POST['id'];

// Verify student belongs to university
$checkQuery = "SELECT id FROM users WHERE id = ? AND university = ?";
$stmt = mysqli_prepare($conn, $checkQuery);
mysqli_stmt_bind_param($stmt, "is", $id, $university);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (!mysqli_fetch_assoc($result)) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    mysqli_stmt_close($stmt);
    exit();
}
mysqli_stmt_close($stmt);

$query = "DELETE FROM users WHERE id = ? AND university = ?";

try {
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "is", $id, $university);
    $result = mysqli_stmt_execute($stmt);
    
    echo json_encode([
        'success' => $result,
        'message' => $result ? 'Student deleted successfully' : 'Error deleting student'
    ]);
    mysqli_stmt_close($stmt);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>