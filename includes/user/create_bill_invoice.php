<?php
error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); // Display errors on the screen
session_start();
require_once '../../config/config.php';
include './functions.php';
if (!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    // Redirect to login page if user is not logged in
    header("Location: ../../dashboard/login");
}

// Get bill ID from URL
$bill_id = isset($_GET['bill_id']) ? intval($_GET['bill_id']) : 0;
$user_id = $_SESSION['user_id'] ?? 0;
if (!$bill_id || !$user_id) {
    header("Location: ../../dashboard/bills.php");
    exit();
}
//If invoice exists, rediret to the created invoice page
$invoicequery = mysqli_query($conn, "SELECT * FROM bill_invoice WHERE uid=$user_id AND bill_id=$bill_id ");
$checkifinvoiceexists = mysqli_num_rows($invoicequery);
while ($row2 = mysqli_fetch_assoc($invoicequery)) {
    $created_invoice_id = $row2["id"];
}
if ($checkifinvoiceexists > 0) {
    header("location: ../../dashboard/invoice?id=$created_invoice_id");
    exit();
}
$sql = mysqli_query($conn, "SELECT * FROM bills WHERE id=$bill_id");
//Redirect back if bill does not exist
if (mysqli_num_rows($sql) < 1) {
    header("Location: ../../dashboard/bills.php");
    exit();
}

// Fetch all bill details
while ($row = mysqli_fetch_array($sql)) {
    $bill_name = $row["name"];
    $amount = $row["price"];
    $due_date = $row["end_date"];
    $university = $row['university'];
}
$uniquecode = generateUniqueCode();
$reference_id = "$university-$uniquecode";
$addinvoice = mysqli_query($conn, "INSERT INTO bill_invoice (uid, name, bill_id, reference_id, due_date, total_amount) VALUES ($user_id, '$bill_name',$bill_id, '$reference_id', '$due_date', '$amount')");

if ($addinvoice) {
    $invoice_id = mysqli_insert_id($conn);
    header("location: ../../dashboard/invoice?id=$invoice_id");
    exit();
} else {
    // Display the MySQL error
    echo "Error: " . mysqli_error($conn);
}
