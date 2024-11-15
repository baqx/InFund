<?php
session_start();
require_once '../../config/config.php';
include './functions.php';
require_once '../../config/secrets.php';

$reference_id = isset($_GET['ref']) ? $_GET['ref'] : 0;

if (!$reference_id) {
    header("Location: ../../dashboard/campaigns.php?ref");
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
        'Authorization: Payaza ' . $PAYAZA_API_KEY_ENCODED
    ),
));

$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response, true);

if ($data && $data['success']) {
    $gatewaytransactionReference = $data['data']['transaction_reference'];
    $amount = $data['data']['amount_received'];
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

$campaign_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$donor_name = isset($_GET['name']) ? trim($_GET['name']) : ' ';
$email = isset($_GET['email']) ? trim($_GET['email']) : null;

// Fetch campaign details using prepared statement
$stmt = $conn->prepare("SELECT * FROM campaigns WHERE id = ?");
$stmt->bind_param("i", $campaign_id);
$stmt->execute();
$result = $stmt->get_result();
$campaign = $result->fetch_assoc();
$stmt->close();

if ($campaign) {
    $campaign_creator = $campaign['uid'];
    $campaign_name = $campaign['title'];
} else {
    echo "Campaign details not found.";
    exit();
}

if ($campaign_id < 0) {
    $_SESSION['error'] = "Invalid donation details";
    header("Location: ../../dashboard/campaign.php?id=" . $campaign_id);
    exit();
}

try {
    if ($transactionStatus === "Completed") {
        // Start transaction
        $conn->begin_transaction();

        // Insert donation record
        $stmt = $conn->prepare("INSERT INTO donations (campaign_id, donor_name, amount, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isds", $campaign_id, $donor_name, $amount, $email);
        $stmt->execute();
        $stmt->close();

        // Update campaign amount_raised
        $stmt = $conn->prepare("UPDATE campaigns SET amount_raised = amount_raised + ? WHERE id = ?");
        $stmt->bind_param("di", $amount, $campaign_id);
        $stmt->execute();
        $stmt->close();

        // Check if campaign goal has been reached
        $stmt = $conn->prepare("UPDATE campaigns SET status = CASE WHEN amount_raised >= goal_amount THEN 'completed' ELSE status END WHERE id = ?");
        $stmt->bind_param("i", $campaign_id);
        $stmt->execute();
        $stmt->close();

        // Update user balance
        $stmt = $conn->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
        $stmt->bind_param("di", $amount, $campaign_creator);
        $stmt->execute();
        $stmt->close();

        // Add to transactions table for campaign creator
        $transaction_name = "Received fund from campaign - " . $campaign_name;
        $transaction_type = "credit";
        $type = "received-donation";
        $status = "success";

        $stmt = $conn->prepare("INSERT INTO transactions (uid, reference_id, type_id, name, amount, transaction_type, type, status, gateway_reference) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isissssss", $campaign_creator, $reference_id, $campaign_id, $transaction_name, $amount, $transaction_type, $type, $status, $gatewaytransactionReference);
        $stmt->execute();
        $stmt->close();

        // Add to transactions table for donor if logged in
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $donor_transaction_name = "Donated funds via gateway to campaign - " . $campaign_name;
            $donor_transaction_type = "donate";

            $stmt = $conn->prepare("INSERT INTO transactions (uid, reference_id, type_id, name, amount, transaction_type, type, status, gateway_reference) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isissssss", $user_id, $reference_id, $campaign_id, $donor_transaction_name, $amount, $donor_transaction_type, $donor_transaction_type, $status, $gatewaytransactionReference);
            $stmt->execute();
            $stmt->close();
        }

        // Commit transaction
        $conn->commit();

        $_SESSION['success'] = "Thank you for your donation! Redirecting to payment gateway...";
        header("Location: ../../dashboard/campaign.php?id=" . $campaign_id);
        exit();
    } else {
        $conn->rollback();
        $_SESSION['error'] = "An error occurred while processing your donation. Please try again.";
        header("Location: ../../dashboard/campaign.php?id=" . $campaign_id);
        exit();
    }
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    $_SESSION['error'] = "An error occurred while processing your donation. Please try again.";
    header("Location: ../../dashboard/campaign.php?id=" . $campaign_id);
    exit();
}
