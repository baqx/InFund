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

$page_title = "Invoice";
$page = "Bills";
$css1 = "invoice";
include '../includes/user/nav.php';
?>

<!-- Add this in the head section after your other scripts -->
<script src="https://checkout-v2.payaza.africa/js/v1/bundle.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generate a unique reference ID if needed
        function generateReference() {
            return 'PL' + Date.now() + Math.floor(Math.random() * 1000);
        }

        function initializePayment() {
            try {
                const payazaCheckout = PayazaCheckout.setup({
                    merchant_key: "<?php echo $PAYAZA_API_KEY; ?>",
                    connection_mode: "Test",
                    checkout_amount: parseFloat(<?php echo json_encode($invoice_details['total_amount']); ?>),
                    currency_code: "NGN",
                    email_address: <?php echo json_encode($invoice_details['email']); ?>,
                    first_name: <?php echo json_encode(explode(' ', $invoice_details['fullname'])[0]); ?>,
                    last_name: <?php echo json_encode(explode(' ', $invoice_details['fullname'])[1]); ?>,
                    phone_number: <?php echo json_encode($invoice_details['phone']); ?>,
                    transaction_reference: <?php echo json_encode($invoice_details['reference_id']); ?>,
                    additional_details: {
                        user_id: <?php echo json_encode($_SESSION['user_id']); ?>,
                        invoice_id: <?php echo json_encode($_GET['id']); ?>
                    }
                });

                // Callback function to handle payment response
                function handlePaymentCallback(response) {
                    console.log('Payment Response:', response);
                    // You can add additional handling here based on the response
                    if (response.status === 'successful') {
                        window.location.href = 'process_transaction.php?ref=' +
                            <?php echo json_encode($invoice_details['reference_id']); ?> +
                            '&status=success';
                    }
                }

                // Handle popup close
                function handleClose() {
                    console.log('Payment popup closed');
                    window.location.href = '../includes/user/process_bill_payment?ref=' +
                        <?php echo json_encode($invoice_details['reference_id']); ?> +
                        '&status=closed';
                }

                // Set up callbacks
                payazaCheckout.setCallback(handlePaymentCallback);
                payazaCheckout.setOnClose(handleClose);

                // Show the payment popup
                payazaCheckout.showPopup();
            } catch (error) {
                console.error('Payment initialization error:', error);
                alert('Unable to initialize payment. Please try again later.');
            }
        }

        // Add click event listeners after DOM is loaded
        const payButton = document.getElementById('payButton');
        if (payButton) {
            payButton.addEventListener('click', initializePayment);
        }

        const printButton = document.getElementById('printButton');
        if (printButton) {
            printButton.addEventListener('click', () => {
                window.print();
            });
        }
    });
</script>

<main class="main-content invoice-container">
    <div class="invoice-header">
        <div class="invoice-title">
            <div>
                <h1><?php echo htmlspecialchars($invoice_details['name']); ?></h1>
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
                <button class="btn btn-primary" id="payButton">
                    <i class="fas fa-credit-card"></i>
                    Pay Now
                </button>
            <?php endif; ?>
            <button class="btn btn-secondary" id="downloadButton">
                <i class="fas fa-download"></i>
                Download Invoice
            </button>
            <button class="btn btn-secondary" id="printButton">
                <i class="fas fa-print"></i>
                Print
            </button>
        </div>
</main>

<?php
include '../includes/user/footer.php';
?>