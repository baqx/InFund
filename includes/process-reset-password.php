<?php
session_start();
require '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['success' => false, 'message' => 'Invalid request']));
}

$token = $_POST['token'] ?? '';
$newPassword = $_POST['new_password'] ?? '';

// Validate inputs
if (empty($token) || empty($newPassword) || strlen($newPassword) < 8) {
    echo json_encode(['success' => false, 'message' => 'Invalid password or token']);
    exit;
}

// Hash the new password
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Start transaction
$conn->begin_transaction();

try {
    // Find the reset link entry
    $stmt = $conn->prepare("
        SELECT u.id, u.email 
        FROM reset_links r 
        JOIN users u ON r.uid = u.id 
        WHERE r.code = ? AND r.link_opened = '0' AND r.timestamp > DATE_SUB(NOW(), INTERVAL 12 HOUR)
    ");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception('Invalid or expired reset link');
    }

    $user = $result->fetch_assoc();
    $userId = $user['id'];

    // Update user password
    $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $updateStmt->bind_param("si", $hashedPassword, $userId);
    $updateStmt->execute();

    // Mark reset link as used
    $markUsedStmt = $conn->prepare("UPDATE reset_links SET link_opened = '1' WHERE code = ?");
    $markUsedStmt->bind_param("s", $token);
    $markUsedStmt->execute();

    // Commit transaction
    $conn->commit();

    echo json_encode(['success' => true, 'message' => 'Password reset successfully']);
} catch (Exception $e) {
    // Rollback transaction
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
exit;
