<?php
// campaign_dashboard.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$page_title = "Campaign Dashboard";
$page = "Campaigns";
$css1 = "campaign_dash";

include '../config/config.php';
include '../includes/get_universities.php';
include '../includes/user/campaign_dash_functions.php';
include '../includes/user/nav.php';

// Verify campaign ID is provided and user is logged in
if (!isset($_GET['id']) || !isset($_SESSION['user_id'])) {
    header('Location: ./campaigns.php');
    exit();
}

$campaign_id = (int)$_GET['id'];
$campaign = getCampaignDetails($campaign_id, $_SESSION['user_id']);

// If campaign doesn't exist or user is not the owner
if (!$campaign) {
    header('Location: ./campaigns.php');
    exit();
}

$donationStats = getDonationStats($campaign_id);
$topDonors = getTopDonors($campaign_id);
$donationsByDate = getDonationsByDate($campaign_id);

// Prepare data for charts
$dates = [];
$amounts = [];
$counts = [];

while ($row = $donationsByDate->fetch_assoc()) {
    $dates[] = $row['donation_date'];
    $amounts[] = $row['daily_amount'];
    $counts[] = $row['donation_count'];
}

$chartData = [
    'dates' => json_encode($dates),
    'amounts' => json_encode($amounts),
    'counts' => json_encode($counts)
];
?>

<main class="main-content">
    <div class="dashboard-header">
        <div class="campaign-title">
            <h1><?php echo htmlspecialchars($campaign['title']); ?></h1>
            <span class="badge <?php echo getBadgeClass($campaign['status']); ?>">
                <?php echo ucfirst($campaign['status']); ?>
            </span>
        </div>
        <div class="header-actions">
            <a href="edit_campaign.php?id=<?php echo $campaign_id; ?>" class="btn btn-secondary">
                <i class="fas fa-edit"></i> Edit Campaign
            </a>
            <button class="btn btn-primary" onclick="shareCampaign()">
                <i class="fas fa-share"></i> Share
            </button>
        </div>
    </div>

    <div class="dashboard-grid">
        <!-- Campaign Progress Card -->
        <div class="dashboard-card campaign-progress">
            <h3>Campaign Progress</h3>
            <div class="progress-stats">
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo min(($campaign['amount_raised'] / $campaign['goal_amount']) * 100, 100); ?>%"></div>
                </div>
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-label">Raised</span>
                        <span class="stat-value">₦<?php echo number_format($campaign['amount_raised'], 2); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Goal</span>
                        <span class="stat-value">₦<?php echo number_format($campaign['goal_amount'], 2); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Donors</span>
                        <span class="stat-value"><?php echo $campaign['donor_count']; ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Days Left</span>
                        <span class="stat-value"><?php echo max(0, floor((strtotime($campaign['end_date']) - time()) / 86400)); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donations Chart -->
        <div class="dashboard-card donations-chart">
            <h3>Donations Over Time</h3>
            <canvas id="donationsChart"></canvas>
        </div>

        <!-- Top Donors -->
        <div class="dashboard-card top-donors">
            <h3>Top Donors</h3>
            <div class="donors-list">
                <?php while ($donor = $topDonors->fetch_assoc()) : ?>
                    <div class="donor-item">
                        <div class="donor-info">
                            <span class="donor-name"><?php echo htmlspecialchars($donor['donor_name']); ?></span>
                            <span class="donor-date"><?php echo date('M d, Y', strtotime($donor['created_at'])); ?></span>
                        </div>
                        <span class="donor-amount">₦<?php echo number_format($donor['amount'], 2); ?></span>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Donation Statistics -->
        <div class="dashboard-card donation-stats">
            <h3>Donation Statistics</h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-label">Total Donations</span>
                    <span class="stat-value"><?php echo $donationStats['total_donations']; ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Average Donation</span>
                    <span class="stat-value">₦<?php echo number_format($donationStats['avg_donation'], 2); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Largest Donation</span>
                    <span class="stat-value">₦<?php echo number_format($donationStats['largest_donation'], 2); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Smallest Donation</span>
                    <span class="stat-value">₦<?php echo number_format($donationStats['smallest_donation'], 2); ?></span>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('donationsChart').getContext('2d');
    const dates = <?php echo $chartData['dates']; ?>;
    const amounts = <?php echo $chartData['amounts']; ?>;
    const counts = <?php echo $chartData['counts']; ?>;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Daily Donations (₦)',
                data: amounts,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1,
                yAxisID: 'y'
            }, {
                label: 'Number of Donations',
                data: counts,
                borderColor: 'rgb(255, 99, 132)',
                tension: 0.1,
                yAxisID: 'y1'
            }]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Amount (₦)'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Number of Donations'
                    },
                    grid: {
                        drawOnChartArea: false
                    }
                }
            }
        }
    });

    window.shareCampaign = function() {
        const url = '<?php $shortLink = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/p/" . htmlspecialchars($campaign['link']);
                            echo $shortLink; ?>';
        if (navigator.share) {
            navigator.share({
                title: <?php echo json_encode($campaign['title']); ?>,
                text: 'Check out this campaign!',
                url: url
            });
        } else {
            // Fallback copy to clipboard
            navigator.clipboard.writeText(url)
                .then(() => alert('Campaign link copied to clipboard!'))
                .catch(err => console.error('Failed to copy:', err));
        }
    };
});
</script>

<?php
$js1 = "campaign_dashboard";
include '../includes/user/footer.php';
?>