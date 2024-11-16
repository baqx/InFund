<?php
session_start();
$page = "Dashboard";
include '../includes/uni/nav.php';
$dashboard_stats = getDashboardStats($university_id);
$faculty_stats = getFacultyStats($university_id);
$recent_bills = getRecentBills($university_id);
?>

<!-- Main Content -->
<div class="main-content">
    <!-- Stats Cards -->
    <div class="cards-grid">
        <div class="card">
            <h2><?php echo number_format($dashboard_stats['total_students']); ?></h2>
            <p>Total Students</p>
        </div>
        <div class="card">
            <h2><?php echo number_format($dashboard_stats['total_campaigns']); ?></h2>
            <p>Active Campaigns</p>
        </div>

        <div class="card">
            <h2><?php echo count($faculty_stats); ?></h2>
            <p>Total Faculties</p>
        </div>
    </div>

    <!-- Campaigns and Bills Grid -->
    <div class="campaigns-grid">
        <!-- Recent Campaigns -->
        <div class="feed-section">
            <div class="section-header">
                <h3>Recent Campaigns</h3>
                <a href="campaigns" class="view-all">View All</a>
            </div>
            <?php foreach ($dashboard_stats['recent_campaigns'] as $campaign) : ?>
                <div class="campaign-card">
                    <div class="campaign-header">
                        <h4 class="campaign-title"><?php echo htmlspecialchars($campaign['title']); ?></h4>
                        <span class="badge <?php echo $campaign['status'] == 'active' ? 'badge-success' : 'badge-info'; ?>">
                            <?php echo ucfirst($campaign['status']); ?>
                        </span>
                    </div>
                    <div class="campaign-meta">
                        By <?php echo htmlspecialchars($campaign['fullname']); ?>
                    </div>
                    <div class="progress-bar">
                        <?php
                        $percentage = ($campaign['amount_raised'] / $campaign['goal_amount']) * 100;
                        ?>
                        <div class="progress-fill" style="width: <?php echo min(100, $percentage); ?>%"></div>
                    </div>
                    <div class="campaign-stats">
                        <span>₦<?php echo number_format($campaign['amount_raised'], 2); ?> raised</span>
                        <span><?php echo round($percentage); ?>%</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Recent Bills -->
        <div class="feed-section">
            <div class="section-header">
                <h3>Recent Bills</h3>
                <a href="bills" class="view-all">View All</a>
            </div>
            <?php foreach ($recent_bills as $bill) : ?>
                <div class="campaign-card">
                    <div class="campaign-header">
                        <h4 class="campaign-title"><?php echo htmlspecialchars($bill['name']); ?></h4>
                        <span class="badge badge-info">₦<?php echo number_format($bill['price'], 2); ?></span>
                    </div>
                    <div class="campaign-meta">
                        Created by <?php echo htmlspecialchars($bill['fullname']); ?>
                    </div>
                    <div class="campaign-stats">
                        <span><?php echo $bill['department']; ?></span>
                        <span><?php echo date('M d, Y', strtotime($bill['created_at'])); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>

</body>

</html>