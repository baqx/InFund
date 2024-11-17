<?php
function getAdminDetails(string $email): array
{
    global $conn;

    if (strpos($email, "@")) {
        $query = "SELECT * FROM creators WHERE email = ?";
    } else {
        $query = "SELECT * FROM creators WHERE id = ?";
    }
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    return $data;
}
