<?php
header('Content-Type: application/json');
require_once '../config/config.php';

$query = "SELECT id, name, abbreviation, type FROM universities ORDER BY name";
$result = mysqli_query($conn, $query);

$universities = [];
while($row = mysqli_fetch_assoc($result)) {
    $universities[] = $row;
}

echo json_encode($universities);
