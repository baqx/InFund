
<?php
// api/get_departments.php
session_start();
require_once '../../config/config.php';

header('Content-Type: application/json');

if (!isset($_GET['university_id']) || !isset($_GET['faculty_id']) || 
    empty($_GET['university_id']) || empty($_GET['faculty_id'])) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT id, name FROM university_departments 
                       WHERE university_id = ? AND faculty_id = ? 
                       ORDER BY name");
$stmt->bind_param('ii', $_GET['university_id'], $_GET['faculty_id']);
$stmt->execute();
$result = $stmt->get_result();

$departments = [];
while ($row = $result->fetch_assoc()) {
    $departments[] = $row;
}

echo json_encode($departments);
?>