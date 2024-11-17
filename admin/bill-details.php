<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$page_title = "Bill Details";
$page = "Bills";
include '../config/config.php';
include '../includes/admin/nav.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: bills.php");
    exit();
}

$bill_id = $_GET['id'];

// Get bill details with student info
$stmt = $conn->prepare("
    SELECT b.*, u.fullname as student_name, u.email as student_email, u.phone as student_phone
    FROM bills b 
    LEFT JOIN users u ON u.matric_no = b.matric_no 
    WHERE b.id = ? AND b.creator_id = ?
");
$stmt->bind_param("ii", $bill_id, $_SESSION['admin_id']);
$stmt->execute();
$result = $stmt->get_result();
$bill = $result->fetch_assoc();

if (!$bill) {
    header("Location: bills.php");
    exit();
}

// Get payment history
$stmt = $conn->prepare("
    SELECT p.*, u.fullname as paid_by
    FROM payments p
    LEFT JOIN users u ON u.id = p.uid
    WHERE p.bill_id = ?
    ORDER BY p.created_at DESC
");
$stmt->bind_param("i", $bill_id);
$stmt->execute();
$payments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Calculate payment statistics
$total_paid = array_sum(array_column($payments, 'amount_paid'));
$balance = $bill['price'] - $total_paid;

function formatAmount($amount)
{
    return '₦' . number_format($amount, 2);
}

function getStatusClass($amount_paid, $total_amount)
{
    if ($amount_paid >= $total_amount) return 'status-paid';
    if ($amount_paid > 0) return 'status-partial';
    return 'status-unpaid';
}

function getPaymentStatus($amount_paid, $total_amount)
{
    if ($amount_paid >= $total_amount) return 'Paid';
    if ($amount_paid > 0) return 'Partially Paid';
    return 'Unpaid';
}
?>

<style>
    .bill-details-container {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .page-header h1 {
        font-size: 1.8rem;
        color: #333;
        margin: 0;
    }

    .back-button {
        color: #666;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .back-button:hover {
        color: #333;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .info-card h3 {
        font-size: 1rem;
        color: #666;
        margin: 0 0 1rem 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-card .value {
        font-size: 1.8rem;
        color: #333;
        font-weight: bold;
    }

    .info-card .subtitle {
        color: #666;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    .details-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .detail-item {
        margin-bottom: 1rem;
    }

    .detail-label {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0.25rem;
    }

    .detail-value {
        font-size: 1rem;
        color: #333;
    }

    .status-badge {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-paid {
        background-color: #E8F5E9;
        color: #2E7D32;
    }

    .status-unpaid {
        background-color: #FFEBEE;
        color: #C62828;
    }

    .status-partial {
        background-color: #FFF3E0;
        color: #EF6C00;
    }

    .payments-table-wrapper {
        overflow-x: auto;
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .payments-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    .payments-table th {
        background-color: #f5f5f5;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #eee;
    }

    .payments-table td {
        padding: 1rem;
        border-bottom: 1px solid #eee;
        color: #666;
    }

    .payments-table tr:last-child td {
        border-bottom: none;
    }

    .amount-cell {
        font-family: monospace;
        font-weight: 600;
    }

    .empty-payments {
        text-align: center;
        padding: 2rem;
        color: #666;
    }

    .export-button {
        background-color: transparent;
        color: var(--primary-color);
        padding: 0.5rem 1rem;
        border: 2px solid var(--primary-color);
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
    }

    .export-button:hover {
        background-color: var(--primary-color);
        color: #fff;
    }

    @media (max-width: 768px) {
        .bill-details-container {
            padding: 1rem;
        }

        .page-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .info-card {
            padding: 1rem;
        }

        .info-card .value {
            font-size: 1.5rem;
        }

        .details-section {
            padding: 1rem;
        }

        .payments-table-wrapper {
            padding: 1rem;
            margin: 0 -1rem;
            border-radius: 0;
        }

    }
</style>

<main class=" main-content">
    <div class="page-header">
        <a href="./bills.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Bills
        </a>
        <h1><?php echo htmlspecialchars($bill['name']); ?></h1>
    </div>

    <div class="info-grid">
        <div class="info-card">
            <h3>Bill Amount</h3>
            <div class="value"><?php echo formatAmount($bill['price']); ?></div>
            <div class="subtitle">Total Amount</div>
        </div>

        <div class="info-card">
            <h3>Amount Paid</h3>
            <div class="value"><?php echo formatAmount($total_paid); ?></div>
            <div class="subtitle">Total Payments Received</div>
        </div>



    </div>

    <div class="details-section">
        <h2>Bill Details</h2>
        <div class="details-grid">



            <div class="detail-item">
                <div class="detail-label">Department</div>
                <div class="detail-value"><?php echo htmlspecialchars($bill['department']); ?></div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Level</div>
                <div class="detail-value"><?php echo htmlspecialchars($bill['level']); ?></div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Start Date</div>
                <div class="detail-value"><?php echo date('M j, Y', strtotime($bill['start_date'])); ?></div>
            </div>

            <div class="detail-item">
                <div class="detail-label">End Date</div>
                <div class="detail-value"><?php echo date('M j, Y', strtotime($bill['end_date'])); ?></div>
            </div>
        </div>
    </div>
    <div class="export-button-container" style="margin-bottom: 1rem;">
        <form action="export_payments.php" method="POST">
            <input type="hidden" name="bill_id" value="<?php echo $bill_id; ?>">
            <button type="submit" class="export-button">Export as Excel</button>
        </form>
    </div>
    <div class="payments-table-wrapper">
        <h2>Payment History</h2>
        <?php if (empty($payments)) : ?>
            <div class="empty-payments">
                <i class="fas fa-receipt"></i>
                <p>No payments recorded yet</p>
            </div>
        <?php else : ?>
            <table class="payments-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Reference ID</th>
                        <th>Paid By</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payments as $payment) : ?>
                        <tr>
                            <td><?php echo date('M j, Y H:i', strtotime($payment['created_at'])); ?></td>
                            <td><?php echo htmlspecialchars($payment['reference_id']); ?></td>
                            <td><?php echo htmlspecialchars($payment['paid_by']); ?></td>
                            <td class="amount-cell"><?php echo formatAmount($payment['amount_paid']); ?></td>
                            <td>
                                <span class="status-badge <?php echo getStatusClass($payment['amount_paid'], $payment['total_amount']); ?>">
                                    <?php echo $payment['status']; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</main>

<?php
$stmt->close();
$conn->close();
include '../includes/admin/footer.php';
?>