<?php
session_start();
include './config/config.php'; 
// Get the 'link' from the URL
if (!isset($_GET['link'])) {
    header("HTTP/1.0 404 Not Found");
    echo "Invalid request.";
    exit;
}

$link = $_GET['link'];

// Query the database to find the campaign ID associated with the provided link
$sql = "SELECT id FROM campaigns WHERE link = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $link);
$stmt->execute();
$stmt->bind_result($campaignId);
$stmt->fetch();
$stmt->close();

// If no matching campaign is found, return a 404 response
if (empty($campaignId)) {
    header("HTTP/1.0 404 Not Found");
    echo "Campaign not found.";
    exit;
}

// Redirect to the campaign page with the found campaign ID
header("Location: ../dashboard/campaign?id=" . $campaignId);
exit;
