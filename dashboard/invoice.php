<?php
session_start();
include '../config/config.php';
require_once '../includes/user/bill_invoice_functions.php';

if (!isset($_GET['id']) || !isset($_SESSION['user_id'])) {
    header('Location: ../dashboard.php');
    exit();
}

$invoice_details = getInvoiceDetails($_GET['id']);

if (!$invoice_details || $invoice_details['uid'] != $_SESSION['user_id']) {
    header('Location: ../dashboard.php');
    exit();
}

// Construct the payment URL
$additional_details = urlencode(json_encode([
    'user_id' => $_SESSION['user_id'],
    'invoice_id' => $_GET['id']
]));

$redirect_url = urlencode('http://localhost/infund/dashboard/process_transaction.php?ref=' . $invoice_details['reference_id']);
$fullname_parts = explode(' ', $invoice_details['fullname']);

$payment_url = 'https://business.payaza.africa/payment-page/?' .
    'merchant_key=PZ78-PKTEST-A16C887D-01BC-4B5F-8C13-84942EDE8005' .
    '&connection_mode=Test' .
    '&checkout_amount=' . $invoice_details['total_amount'] .
    '&currency_code=NGN' .
    '&email_address=' . urlencode($invoice_details['email']) .
    '&first_name=' . urlencode(explode(' ', $invoice_details['fullname'])[0]) .
    '&last_name=' . urlencode(end($fullname_parts)) .
    '&phone_number=' . urlencode($invoice_details['phone']) .
    '&transaction_reference=' . urlencode($invoice_details['reference_id']) .
    '&additional_details=' . $additional_details .
    '&redirect_url=' . $redirect_url;

$page_title = "Invoice";
$page = "Invoice";
$css1 = "invoice";
include '../includes/user/nav.php';
?>

<main class="main-content invoice-container">
    <div class="invoice-header">
        <div class="invoice-title">
            <div>
                <h1>Invoice</h1>
                <span class="invoice-id">REF: #<span id="referenceId"><?php echo htmlspecialchars($invoice_details['reference_id']); ?></span></span>
            </div>
            <span class="status-badge status-<?php echo strtolower($invoice_details['status']); ?>" id="statusBadge">
                <?php echo htmlspecialchars($invoice_details['status']); ?>
            </span>
        </div>

        <div class="invoice-meta">
            <div class="meta-item">
                <span class="meta-label">Issue Date</span>
                <span class="meta-value" id="createdDate"><?php echo date('F d, Y', strtotime($invoice_details['start_date'])); ?></span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Due Date</span>
                <span class="meta-value" id="dueDate"><?php echo date('F d, Y', strtotime($invoice_details['end_date'])); ?></span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Bill ID</span>
                <span class="meta-value" id="billId">#<?php echo htmlspecialchars($invoice_details['bill_id']); ?></span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Last Updated</span>
                <span class="meta-value" id="updatedDate"><?php echo date('F d, Y', strtotime($invoice_details['updated_at'])); ?></span>
            </div>
        </div>

        <div class="invoice-amount">
            <h2>Total Amount Due</h2>
            <div class="amount-value" id="totalAmount"><?php echo formatAmount($invoice_details['total_amount']); ?></div>
            <?php if ($invoice_details['status'] == 'Paid') : ?>
                <div class="funding-status" id="fundingStatus">
                    <i class="fas fa-check-circle funding-icon"></i>
                    <span>Paid</span>
                </div>
            <?php endif; ?>
        </div>

        <div class="action-buttons">
            <?php if ($invoice_details['status'] == 'Pending') : ?>
                <a href="<?php echo htmlspecialchars($payment_url); ?>" class="btn btn-primary">
                    <i class="fas fa-credit-card"></i>
                    Pay Now
                </a>
            <?php endif; ?>
            <button class="btn btn-secondary" id="downloadButton">
                <i class="fas fa-download"></i>
                Download Invoice
            </button>
            <button class="btn btn-secondary" onclick="window.print()">
                <i class="fas fa-print"></i>
                Print
            </button>
        </div>
    </div>
</main>
</body>