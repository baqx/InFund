<?php
session_start();
require_once '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: campaigns.php");
    exit();
}

$campaign_id = isset($_POST['campaign_id']) ? intval($_POST['campaign_id']) : 0;
$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
$donor_name = isset($_POST['donor_name']) ? trim($_POST['donor_name']) : 'Anonymous';
$email = isset($_POST['email']) ? trim($_POST['email']) : null;

if ($campaign_id <= 0 || $amount < 100) {
    $_SESSION['error'] = "Invalid donation details";
    header("Location: campaign.php?id=" . $campaign_id);
    exit();
}

try {
    // Start transaction
    $conn->begin_transaction();

    // Insert donation record
    $query = "INSERT INTO donations (campaign_id, donor_name, amount, email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isds", $campaign_id, $donor_name, $amount, $email);
    $stmt->execute();

    // Update campaign amount_raised
    $query = "UPDATE campaigns 
              SET amount_raised = amount_raised + ? 
              WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("di", $amount, $campaign_id);
    $stmt->execute();

    // Check if campaign goal has been reached
    $query = "UPDATE campaigns 
              SET status = CASE 
                  WHEN amount_raised >= goal_amount THEN 'completed' 
                  ELSE status 
              END 
              WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $campaign_id);
    $stmt->execute();

    // Commit transaction
    $conn->commit();

    // Here you would typically integrate with a payment gateway
    // For demonstration, we'll just redirect back with a success message
    $_SESSION['success'] = "Thank you for your donation! Redirecting to payment gateway...";

    // In a real application, you would redirect to your payment gateway here
    // For example:
    // header("Location: payment_gateway.php?donation_id=" . $stmt->insert_id);

    // For now, we'll redirect back to the campaign page
    header("Location: ../../dashboard/campaign.php?id=" . $campaign_id);
    exit();
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();

    $_SESSION['error'] = "An error occurred while processing your donation. Please try again.";
    header("Location: ../../dashboard/campaign.php?id=" . $campaign_id);
    exit();
}
