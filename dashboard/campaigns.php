<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$page_title = "Campaigns";
$page = "Campaigns";
$css1 = "bills_campaigns";
include '../config/config.php';
include '../includes/get_universities.php';
include '../includes/user/nav.php';

$university = get_university($my_details['university']);
$campaigns = getCampaignsByUserId($_SESSION['user_id']);
?>

<main class="main-content">
    <div class="server-details">
        <i class="fas fa-university"></i> <?php echo $university[0]['name'] ?? 'University Not Found'; ?>
        <br>
        <i class="fas fa-columns"></i> <?php echo $my_details['department']; ?> department
    </div>

    <div class="page-header">
        <h1>Your Campaigns</h1>
        <div class="header-actions">
            <div class="filter-section">
                <select class="filter-select">
                    <option value="all">All Campaigns</option>
                    <option value="active">Active</option>
                    <option value="completed">Completed</option>
                    <option value="draft">Draft</option>
                </select>
                <input type="text" class="search-input" placeholder="Search campaigns...">
            </div>
            <a href="./create" class="create-button"><i class="fas fa-plus"></i> Create Campaign</a>
        </div>
    </div>

    <div class="campaigns-list">
        <?php
        if ($campaigns->num_rows > 0) :
            while ($campaign = $campaigns->fetch_assoc()) :
        ?>
                <div class="campaign-card">
                    <div class="campaign-header">
                        <div class="campaign-title">
                            <h3><?php echo htmlspecialchars($campaign['title']); ?></h3>
                            <span class="badge <?php echo getBadgeClass($campaign['status']); ?>">
                                <?php echo ucfirst($campaign['status']); ?>
                            </span>
                        </div>
                        <div class="campaign-actions">
                            <a href="campaign.php?id=<?php echo $campaign['id']; ?>"  class="action-button"><i class="fas fa-edit"></i></a>
                            <button class="action-button"><i class="fas fa-chart-bar"></i></button>
                            <button class="action-button"><i class="fas fa-share"></i></button>
                        </div>
                    </div>
                    <div class="campaign-details">
                        <div class="progress-section">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: <?php echo ($campaign['amount_raised'] / $campaign['goal_amount']) * 100; ?>%"></div>
                            </div>
                            <div class="campaign-stats">
                                <span>₦<?php echo number_format($campaign['amount_raised'], 2); ?> raised</span>
                                <span>of ₦<?php echo number_format($campaign['goal_amount'], 2); ?></span>
                            </div>
                        </div>
                        <div class="campaign-meta">
                            <span><i class="fas fa-calendar"></i> <?php echo date('M d, Y', strtotime($campaign['end_date'])); ?></span>
                            <span><i class="fas fa-users"></i> <?php echo $campaign['donor_count']; ?> donors</span>
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
        else :
            ?>
            <div class="empty-state">
                <i class="fas fa-hand-holding-usd"></i>
                <h2>No Campaigns Yet</h2>
                <p>Start your first fundraising campaign today!</p>
                <a href="./create" class="create-button">Create Campaign</a>
            </div>
        <?php endif; ?>
    </div>

    <?php if (empty($campaigns)) : ?>
        <div class="empty-state">
            <i class="fas fa-hand-holding-usd"></i>
            <h2>No Campaigns Yet</h2>
            <p>Start your first fundraising campaign today!</p>
            <a href="./create" class="create-button">Create Campaign</a>
        </div>
    <?php endif; ?>
</main>

<?php
$js1 = "campaigns";
include '../includes/user/footer.php';
?>
<?php
function getBadgeClass($status)
{
    switch ($status) {
        case 'active':
            return 'badge-success';
        case 'completed':
            return 'badge-info';
        case 'draft':
            return 'badge-warning';
        default:
            return 'badge-info';
    }
}
?>