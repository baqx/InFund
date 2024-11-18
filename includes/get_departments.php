<?php
header('Content-Type: application/json');
require_once '../config/config.php';

$university = mysqli_real_escape_string($conn, $_GET['university']);
$faculty_id = mysqli_real_escape_string($conn, $_GET['faculty']);

$query = "SELECT id, name 
    FROM university_departments 
    WHERE university_id = (
        SELECT id 
        FROM universities 
        WHERE abbreviation = ?
    ) 
    AND faculty_id = ? 
    ORDER BY name";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "si", $university, $faculty_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$departments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $departments[] = $row;
}

echo json_encode($departments);
