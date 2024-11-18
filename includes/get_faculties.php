<?php

header('Content-Type: application/json');
require_once '../config/config.php';

$university = mysqli_real_escape_string($conn, $_GET['university']);

$query = "
    SELECT id, name 
    FROM university_faculties 
    WHERE university_id = (
        SELECT id 
        FROM universities 
        WHERE abbreviation = ?
    ) 
    ORDER BY name";
          
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $university);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$faculties = [];
while($row = mysqli_fetch_assoc($result)) {
    $faculties[] = $row;
}

echo json_encode($faculties);

