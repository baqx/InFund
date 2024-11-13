<?php
// Import the secrets file
session_start();
require_once '../../config/config.php';
include './functions.php';
require_once '../../config/secrets.php';

if (!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    // Redirect to login page if user is not logged in
    header("Location: ../../dashboard/login");
    exit();
}

// Get bill Merchant Reference ID from URL
$reference_id = isset($_GET['ref']) ? $_GET['ref'] : 0;
$user_id = $_SESSION['user_id'] ?? 0;

if (!$reference_id || !$user_id) {
    header("Location: ../../dashboard/bills.php");
    exit();
}

// Retrieve invoice details
$sql = mysqli_query($conn, "SELECT * FROM bill_invoice WHERE reference_id ='$reference_id'");
$invoiceData = mysqli_fetch_assoc($sql);

if ($invoiceData) {
    $bill_id = $invoiceData['bill_id'];
    $invoice_id = $invoiceData['id'];
} else {
    echo "Invoice not found.";
    exit();
}

// Fetch bill details
$fetchbills = mysqli_query($conn, "SELECT * FROM bills WHERE id ='$bill_id'");
$bill = mysqli_fetch_assoc($fetchbills);

if ($bill) {
    $price = $bill['price'];
    $billName = $bill['name'];
} else {
    echo "Bill details not found.";
    exit();
}

// Check for transaction status from API
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.payaza.africa/live/merchant-collection/transfer_notification_controller/merchant/transaction-query?merchant_reference=" . urlencode($reference_id),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Payaza ' . $PAYAZA_API_KEY_ENCODED // Use the imported API key here
    ),
));

$response = curl_exec($curl);
curl_close($curl);

// Decode the JSON data into a PHP associative array
$data = json_decode($response, true);

// Check if decoding was successful and the 'success' field is true
if ($data && $data['success']) {
    // Extract the fields you want
    $gatewaytransactionReference = $data['data']['transaction_reference'];
    $amountReceived = $data['data']['amount_received'];
    $transactionFee = $data['data']['transaction_fee'];
    $transactionStatus = $data['data']['transaction_status'];
    $senderName = $data['data']['sender_name'];
    $senderAccountNumber = $data['data']['sender_account_number'];
    $sourceBankName = $data['data']['source_bank_name'];
    $initiatedDate = $data['data']['initiated_date'];
    $currentStatusDate = $data['data']['current_status_date'];
    $currency = $data['data']['currency'];
    $transactionType = $data['data']['transaction_type'];
} else {
    echo "Failed to retrieve transaction data.";
    exit();
}

if ($transactionStatus === "Completed") {
    // Update Invoice Status to Paid
    $sql1 = mysqli_query($conn, "UPDATE bill_invoice SET status='Paid' WHERE reference_id='$reference_id'");

    // Determine payment status
    $pay_status = ($amountReceived >= $price) ? "Paid" : "Partially Paid";

    // Insert into payments
    $sql2 = mysqli_query($conn, "INSERT INTO payments (uid, reference_id, bill_id, student_id, total_amount, amount_paid, status) 
                                  VALUES ($user_id, '$reference_id', '$bill_id', $user_id, '$price', '$amountReceived', '$pay_status')");

    // Insert into transactions
    $sql3 = mysqli_query($conn, "INSERT INTO transactions (uid, reference_id, type_id, name, amount, transaction_type, type, status) 
                                  VALUES ($user_id, '$reference_id', '$bill_id', 'Paid - $billName', '$amountReceived', 'debit', 'bill-payment', 'success')");

    if ($sql1 && $sql2 && $sql3) {
        header("Location: ../../dashboard/invoice.php?id=$invoice_id");
        exit();
    } else {
        echo "Failed to record transaction details.";
    }
} elseif ($transactionStatus === "Failed") {
    $del = mysqli_query($conn, "DELETE FROM bill_invoice WHERE reference_id='$reference_id'");
    if ($del) {
        header("Location: ../../dashboard/bill.php?id=$bill_id");
        exit();
    }
} else {
    header("Location: ../../dashboard/invoice.php?id=$invoice_id");
    exit();
}
