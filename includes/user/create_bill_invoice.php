<?php
error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); // Display errors on the screen
session_start();
require_once '../../config/config.php';
include './functions.php';

if (!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    // Redirect to login page if user is not logged in
    header("Location: ../../dashboard/login");
    exit();
}

// Get bill ID from URL
$bill_id = isset($_GET['bill_id']) ? intval($_GET['bill_id']) : 0;
$user_id = $_SESSION['user_id'] ?? 0;

if (!$bill_id || !$user_id) {
    header("Location: ../../dashboard/bills.php");
    exit();
}

// Check if invoice already exists
$stmt = $conn->prepare("SELECT id FROM bill_invoice WHERE uid = ? AND bill_id = ?");
$stmt->bind_param("ii", $user_id, $bill_id);
$stmt->execute();
$stmt->store_result();
$checkifinvoiceexists = $stmt->num_rows;

if ($checkifinvoiceexists > 0) {
    $stmt->bind_result($created_invoice_id);
    $stmt->fetch();
    $stmt->close();
    header("Location: ../../dashboard/invoice?id=$created_invoice_id");
    exit();
}
$stmt->close();

// Check if bill exists
$stmt = $conn->prepare("SELECT name, price, end_date, university FROM bills WHERE id = ?");
$stmt->bind_param("i", $bill_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows < 1) {
    $stmt->close();
    header("Location: ../../dashboard/bills.php");
    exit();
}

// Fetch bill details
$stmt->bind_result($bill_name, $amount, $due_date, $university);
$stmt->fetch();
$stmt->close();

$uniquecode = generateUniqueCode();
$reference_id = "$university-$uniquecode";

// Insert new invoice
$stmt = $conn->prepare("INSERT INTO bill_invoice (uid, name, bill_id, reference_id, due_date, total_amount) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isissd", $user_id, $bill_name, $bill_id, $reference_id, $due_date, $amount);

if ($stmt->execute()) {
    $invoice_id = $stmt->insert_id;
    $stmt->close();
    header("Location: ../../dashboard/invoice?id=$invoice_id");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
