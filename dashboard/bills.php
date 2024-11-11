<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$page_title = "Bills";
$page = "Bills";
$css1 = "bills_campaigns";

include '../config/config.php';
include '../includes/get_universities.php';
include '../includes/user/get_bills.php';
include '../includes/user/nav.php';

$university = get_university($my_details['university']);
$bills = getBillsByDepartment($my_details['department'], $_SESSION['user_id']);

function getBadgeClass($status) {
    switch ($status) {
        case 'Paid':
            return 'badge-success';
        case 'Partially Paid':
            return 'badge-info';
        default:
            return 'badge-warning';
    }
}
?>

<main class="main-content">
    <div class="server-details">
        <i class="fas fa-university"></i> <?php echo $university[0]['name'] ?? 'University Not Found'; ?>
        <br>
        <i class="fas fa-columns"></i> <?php echo $my_details['department']; ?> department
    </div>

    <div class="page-header">
        <h1>Outstanding Bills</h1>
        <div class="filter-section">
            <select class="filter-select">
                <option value="all">All Bills</option>
                <option value="unpaid">Unpaid</option>
                <option value="partially">Partially Paid</option>
                <option value="paid">Paid</option>
            </select>
            <input type="text" class="search-input" placeholder="Search bills...">
        </div>
    </div>

    <div class="bills-grid">
        <?php if (!empty($bills)): ?>
            <?php foreach ($bills as $bill): ?>
                <?php
                $payment_status = $bill['payment_status'] ?? 'Unpaid';
                $badge_class = getBadgeClass($payment_status);
                $amount_display = '₦' . number_format($bill['price'], 2);
                if (isset($bill['amount_paid']) && $bill['amount_paid'] > 0) {
                    $amount_display .= ' (₦' . number_format($bill['amount_paid'], 2) . ' paid)';
                }
                ?>
                <div class="bill-card" data-status="<?php echo strtolower($payment_status); ?>">
                    <div class="bill-header">
                        <div class="bill-title">
                            <h3><?php echo htmlspecialchars($bill['name']); ?></h3>
                            <span class="badge <?php echo $badge_class; ?>">
                                <?php echo $payment_status; ?>
                            </span>
                        </div>
                        <div class="bill-amount"><?php echo $amount_display; ?></div>
                    </div>
                    <div class="bill-details">
                        <div class="bill-info">
                            <span><i class="fas fa-calendar"></i> Due: <?php echo date('M d, Y', strtotime($bill['end_date'])); ?></span>
                            <span><i class="fas fa-hourglass-half"></i> <?php echo $bill['days_remaining']; ?> days remaining</span>
                        </div>
                        <p class="bill-description">
                            <?php echo htmlspecialchars($bill['faculty'] . ' - ' . $bill['level'] . ' Level'); ?>
                        </p>
                    </div>
                    <?php if ($payment_status !== 'Paid'): ?>
                        <div class="bill-actions">
                            <a href="bill.php?id=<?php echo $bill['id']; ?>" class="pay-button">Pay Now</a>
                            <button class="remind-button"><i class="fas fa-bell"></i> Set Reminder</button>
                        </div>
                    <?php endif; ?>
                    <?php if ($payment_status == 'Paid'): ?>
                        <div class="bill-actions">
                            <a href="bill.php?id=<?php echo $bill['id']; ?>"  class="remind-button"><i class="fas fa-info-circle"></i> Details</a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-file-invoice-dollar"></i>
                <h2>No Bills Found</h2>
                <p>You don't have any outstanding bills at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
const filterSelect = document.querySelector('.filter-select');
const searchInput = document.querySelector('.search-input');
const billCards = document.querySelectorAll('.bill-card');

function filterBills() {
    const filterValue = filterSelect.value;
    const searchValue = searchInput.value.toLowerCase();

    billCards.forEach(card => {
        const status = card.dataset.status;
        const title = card.querySelector('h3').textContent.toLowerCase();
        const description = card.querySelector('.bill-description').textContent.toLowerCase();

        let matchesFilter = filterValue === 'all';
        if (filterValue === 'unpaid') matchesFilter = status === 'unpaid';
        if (filterValue === 'partially') matchesFilter = status === 'partially paid';
        if (filterValue === 'paid') matchesFilter = status === 'paid';

        const matchesSearch = title.includes(searchValue) || description.includes(searchValue);

        card.style.display = matchesFilter && matchesSearch ? 'block' : 'none';
    });
}

filterSelect.addEventListener('change', filterBills);
searchInput.addEventListener('input', filterBills);
</script>