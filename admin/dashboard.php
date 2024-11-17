<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$page_title = "Admin Overview";
$page = "Dashboard";
include '../config/config.php';
include '../includes/admin/nav.php';

// Get admin details
$stmt = $conn->prepare("SELECT * FROM creators WHERE id = ?");
$stmt->bind_param("i", $_SESSION['admin_id']);
$stmt->execute();
$result = $stmt->get_result();
$admin_details = $result->fetch_assoc();

// Get total bills created by admin
$stmt = $conn->prepare("SELECT COUNT(*) as total_bills, COALESCE(SUM(price), 0) as total_amount FROM bills WHERE creator_id = ?");
$stmt->bind_param("i", $_SESSION['admin_id']);
$stmt->execute();
$result = $stmt->get_result();
$bills_stats = $result->fetch_assoc();

// Get recent bills (last 5)
$stmt = $conn->prepare("SELECT b.*, u.fullname as student_name 
                       FROM bills b 
                       LEFT JOIN users u ON u.matric_no = b.matric_no 
                       WHERE b.creator_id = ? 
                       ORDER BY b.created_at DESC LIMIT 5");
$stmt->bind_param("i", $_SESSION['admin_id']);
$stmt->execute();
$result = $stmt->get_result();
$recent_bills = $result->fetch_all(MYSQLI_ASSOC);

// Get recent campaigns from students in same university and department
$stmt = $conn->prepare("SELECT c.*, u.fullname as student_name 
                       FROM campaigns c 
                       JOIN users u ON u.id = c.uid 
                       WHERE u.university = ? 
                       AND u.department = ? 
                       ORDER BY c.created_at DESC LIMIT 5");
$stmt->bind_param("ss", $admin_details['university'], $admin_details['department']);
$stmt->execute();
$result = $stmt->get_result();
$recent_campaigns = $result->fetch_all(MYSQLI_ASSOC);

function getProgressPercentage($raised, $goal) {
    return min(($raised / $goal) * 100, 100);
}

function formatAmount($amount) {
    return '₦' . number_format($amount, 2);
}
?>

<main class="main-content">
    <div class="server-details">
        <h3><i class="fas fa-university"></i> <?php echo htmlspecialchars($admin_details['university']); ?> - <?php echo htmlspecialchars($admin_details['department']); ?> dept.</h3>
    </div>
    
    <div class="cards-grid">
        <div class="card">
            <h2><?php echo formatAmount($admin_details['balance']); ?></h2>
            <p>Balance</p>
        </div>
        <div class="card">
            <h2><?php echo $bills_stats['total_bills']; ?></h2>
            <p>Total Bills Created</p>
        </div>
        <div class="card">
            <h2><?php echo formatAmount($bills_stats['total_amount']); ?></h2>
            <p>Total Amount Billed</p>
        </div>
        <div class="card">
            <h2><?php echo count($recent_campaigns); ?></h2>
            <p>Active Student Campaigns</p>
        </div>
    </div>

    <div class="campaigns-grid">
        <section class="feed-section">
            <div class="section-header">
                <h2>Recent Bills</h2>
                <a href="./create-bill.php" class="view-all">Create Bill</a>
            </div>
            <?php if (empty($recent_bills)): ?>
                <p>No bills created yet</p>
            <?php else: ?>
                <?php foreach ($recent_bills as $bill): ?>
                    <div class="campaign-card">
                        <div class="campaign-header">
                            <div>
                                <h3 class="campaign-title"><?php echo htmlspecialchars($bill['name']); ?></h3>
                                <p class="campaign-meta">Student: <?php echo htmlspecialchars($bill['student_name']); ?></p>
                                <p class="campaign-meta">Matric No: <?php echo htmlspecialchars($bill['matric_no']); ?></p>
                            </div>
                            <span class="badge badge-info"><?php echo formatAmount($bill['price']); ?></span>
                        </div>
                        <div class="campaign-meta">
                            <span>Created: <?php echo date('M j, Y', strtotime($bill['created_at'])); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

        <section class="feed-section">
            <div class="section-header">
                <h2>Student Campaigns</h2>
                <a href="./campaigns.php" class="view-all">View All</a>
            </div>
            <?php if (empty($recent_campaigns)): ?>
                <p>No active campaigns</p>
            <?php else: ?>
                <?php foreach ($recent_campaigns as $campaign): ?>
                    <div class="campaign-card">
                        <div class="campaign-header">
                            <div>
                                <h3 class="campaign-title"><?php echo htmlspecialchars($campaign['title']); ?></h3>
                                <p class="campaign-meta">By: <?php echo htmlspecialchars($campaign['student_name']); ?></p>
                            </div>
                            <span class="badge <?php echo $campaign['status'] === 'active' ? 'badge-success' : 'badge-info'; ?>">
                                <?php echo ucfirst($campaign['status']); ?>
                            </span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?php echo getProgressPercentage($campaign['amount_raised'], $campaign['goal_amount']); ?>%"></div>
                        </div>
                        <div class="campaign-stats">
                            <span>Raised: <?php echo formatAmount($campaign['amount_raised']); ?></span>
                            <span>Goal: <?php echo formatAmount($campaign['goal_amount']); ?></span>
                        </div>
                        <div class="campaign-meta">
                            <span>Spam Level: <?php echo number_format($campaign['spam_level'], 2); ?>%</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </div>
</main>

<?php 
$stmt->close();
$conn->close();
include '../includes/admin/footer.php'; 
?>
