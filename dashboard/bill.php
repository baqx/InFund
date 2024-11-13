<?php
session_start();
require_once '../config/config.php';
include '../includes/user/get_bills.php';

// Get bill ID from URL
$bill_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = $_SESSION['user_id'] ?? 0;

if (!$bill_id || !$user_id) {
    header("Location: bills.php");
    exit();
}

// Fetch bill details with payment status
$bill = getBillDetails($bill_id, $user_id);
if (!$bill) {
    header("Location: bills.php");
    exit();
}

// Set default values for payment-related fields if no payment record exists
if (!isset($bill['payment_status'])) {
    $bill['payment_status'] = 'Unpaid';
    $bill['amount_paid'] = 0;
    $bill['reference_id'] = null;
    $bill['last_payment_date'] = null;
}

// Calculate progress percentage
$progress = ($bill['amount_paid'] / $bill['price']) * 100;

// Determine payment status class
function getStatusClass($status)
{
    switch ($status) {
        case 'Paid':
            return 'status-paid';
        case 'Partially Paid':
            return 'status-partial';
        case 'Unpaid':
        default:
            return 'status-pending';
    }
}

$page_title = "Bill Information";
$page = "Bills";
$css1 = "bill";
include '../includes/user/nav.php';
?>

<main class="main-content">
    <div class="bill-detail-header">
        <h1 class="bill-title"><?php echo htmlspecialchars($bill['name']); ?></h1>
        <div class="bill-meta">
            <div class="meta-item">
                <i class="fas fa-university"></i>
                <span><?php echo htmlspecialchars($bill['university']); ?></span>
            </div>
            <div class="meta-item">
                <i class="fas fa-graduation-cap"></i>
                <span><?php echo htmlspecialchars($bill['faculty']); ?></span>
            </div>
            <div class="meta-item">
                <i class="fas fa-book"></i>
                <span><?php echo htmlspecialchars($bill['department']); ?></span>
            </div>
            <div class="meta-item">
                <i class="fas fa-layer-group"></i>
                <span><?php echo htmlspecialchars($bill['level']); ?> Level</span>
            </div>
            <?php if ($bill['matric_no'] !== 'ALL') : ?>
                <div class="meta-item">
                    <i class="fas fa-id-card"></i>
                    <span>Matric: <?php echo htmlspecialchars($bill['matric_no']); ?></span>
                </div>
            <?php endif; ?>
            <div class="meta-item">
                <span class="status-badge <?php echo getStatusClass($bill['payment_status']); ?>">
                    <?php echo htmlspecialchars($bill['payment_status']); ?>
                </span>
            </div>
        </div>

        <div class="progress-section">
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?php echo min(100, $progress); ?>%"></div>
            </div>
            <div class="progress-stats">
                <span>₦<?php echo number_format($bill['amount_paid'], 2); ?> paid</span>
                <span>₦<?php echo number_format($bill['price'], 2); ?> total</span>
            </div>
        </div>

        <div class="date-info">
            <div class="date-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Start Date: <?php echo date('F j, Y', strtotime($bill['start_date'])); ?></span>
            </div>
            <div class="date-item">
                <i class="fas fa-calendar-check"></i>
                <span>Due Date: <?php echo date('F j, Y', strtotime($bill['end_date'])); ?></span>
            </div>
            <div class="date-item">
                <i class="fas fa-clock"></i>
                <span>Days Left: <?php echo max(0, $bill['days_remaining']); ?> days</span>
            </div>
        </div>
    </div>

    <div class="bill-content">
        <div class="bill-description">
            <h2>Bill Details</h2>
            <div class="description-content">
                <div class="info-grid">
                    <div class="info-item">
                        <label>Bill Name:</label>
                        <span><?php echo htmlspecialchars($bill['name']); ?></span>
                    </div>
                    <div class="info-item">
                        <label>Created By:</label>
                        <span><?php echo htmlspecialchars($bill['creator_name'] ?? 'N/A'); ?></span>
                    </div>
                    <div class="info-item">
                        <label>Faculty:</label>
                        <span><?php echo htmlspecialchars($bill['faculty']); ?></span>
                    </div>
                    <div class="info-item">
                        <label>Department:</label>
                        <span><?php echo htmlspecialchars($bill['department']); ?></span>
                    </div>
                    <div class="info-item">
                        <label>Level:</label>
                        <span><?php echo htmlspecialchars($bill['level']); ?></span>
                    </div>
                    <div class="info-item">
                        <label>Applicable to:</label>
                        <span><?php echo $bill['matric_no'] === 'ALL' ? 'All Students' : 'Matric: ' . htmlspecialchars($bill['matric_no']); ?></span>
                    </div>
                </div>
            </div>

            <?php if ($bill['last_payment_date'] && $bill['amount_paid'] > 0) : ?>
                <div class="payment-history">
                    <h2>Payment History</h2>
                    <div class="payment-card">
                        <div class="payment-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="payment-info">
                            <div class="reference-id">Ref: <?php echo htmlspecialchars($bill['reference_id']); ?> <div class="download-receipt">
                                    <a href="./generate_receipt.php?id=<?php echo $bill['id']; ?>" class="download-button">Download Receipt as PDF</a>
                                </div>
                            </div>
                            <div class="payment-amount">₦<?php echo number_format($bill['amount_paid'], 2); ?></div>
                            <div class="payment-date">
                                <?php echo date('F j, Y', strtotime($bill['last_payment_date'])); ?>
                            </div>
                        </div>
                        <div class="payment-status">
                            <span class="status-badge <?php echo getStatusClass($bill['payment_status']); ?>">
                                <?php echo htmlspecialchars($bill['payment_status']); ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="payment-section">
            <h2>Payment Details</h2>
            <div class="payment-summary">
                <div class="summary-item">
                    <label>Total Amount:</label>
                    <span>₦<?php echo number_format($bill['price'], 2); ?></span>
                </div>
                <div class="summary-item">
                    <label>Amount Paid:</label>
                    <span>₦<?php echo number_format($bill['amount_paid'], 2); ?></span>
                </div>
                <div class="summary-item">
                    <label>Balance:</label>
                    <span>₦<?php echo number_format($bill['price'] - $bill['amount_paid'], 2); ?></span>
                </div>
                <div class="summary-item">
                    <label>Due Date:</label>
                    <span><?php echo date('F j, Y', strtotime($bill['end_date'])); ?></span>
                </div>
            </div>
            <?php if ($bill['payment_status'] !== 'Paid') : ?>
                <a href="../includes/user/create_bill_invoice?bill_id=<?php echo $bill_id; ?>"><button class="pay-button">
                        Pay Now
                    </button></a>
            <?php endif; ?>
        </div>
    </div>
</main>


<?php
$js1 = "bill";
include '../includes/user/footer.php';
?>