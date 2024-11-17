<?php
// api/get_faculties.php
session_start();
require_once '../../config/config.php';

header('Content-Type: application/json');

if (!isset($_GET['university_id']) || empty($_GET['university_id'])) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT id, name FROM university_faculties WHERE university_id = ? ORDER BY name");
$stmt->bind_param('i', $_GET['university_id']);
$stmt->execute();
$result = $stmt->get_result();

$faculties = [];
while ($row = $result->fetch_assoc()) {
    $faculties[] = $row;
}

echo json_encode($faculties);
?>
