<?php
ini_set('display_errors', 1);          // Enable displaying errors
ini_set('display_startup_errors', 1);  // Enable displaying startup errors
error_reporting(E_ALL);
session_start();
$page_title = "Overview";
$page = "Overview";
include '../config/config.php';
include '../includes/get_universities.php';
include '../includes/user/get_bills.php';
include '../includes/user/nav.php';


$university = get_university($my_details['university']);

// Get campaigns and stats
$campaigns = getCampaignsByUserId($_SESSION['user_id']);
$campaign_stats = getCampaignStats($campaigns);
?>

<main class="main-content">
    <div class="server-details">
        <i class="fas fa-university"></i> <?php
                                            if (!empty($university)) {
                                                $university_name = $university[0]['name'];
                                                echo $university_name;
                                            } else {
                                                echo "No university found with the abbreviation: " . $abbreviation;
                                            } ?>
        <br>
        <i class="fas fa-columns"></i> <?php echo $my_details['department']; ?> department
    </div>
    <div class="cards-grid">
        <div class="card">
            <h2>₦<?php echo $my_details['balance']; ?></h2>
            <p>Balance </p>
        </div>
        <div class="card">
            <h2><?php echo $campaign_stats['active_campaigns']; ?></h2>
            <p>Active Campaigns</p>
        </div>
        <div class="card">
            <h2>2</h2>
            <p>Pending Bills</p>
        </div>
        <div class="card">
            <h2>₦<?php echo number_format($campaign_stats['total_raised'], 2); ?></h2>
            <p>Total Raised</p>
        </div>
    </div>

    <div class="campaigns-grid">
        <section class="feed-section">
            <div class="section-header">
                <h2>Your Campaigns</h2>
                <a href="./create" class="view-all">Create Campaign</a>
            </div>
            <?php echo displayCampaignSection($campaigns); ?>
        </section>

        <section class="feed-section">
            <div class="section-header">
                <h2>Outstanding Payments</h2>
                <a href="bills.php" class="view-all">View All</a>
            </div>
            <?php
            $bills = getBillsByDepartment($my_details['department'], $_SESSION['user_id']);
            echo displayBillsSection($bills);
            ?>
        </section>
    </div>
</main>


<?php
$js1 = "overview";
include '../includes/user/footer.php';
?>