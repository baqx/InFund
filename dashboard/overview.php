<?php
ini_set('display_errors', 1);          // Enable displaying errors
ini_set('display_startup_errors', 1);  // Enable displaying startup errors
error_reporting(E_ALL);
session_start();
$css1="chart";
$page_title = "Overview";
$page = "Overview";
$css2 = "discover-campaign-section";
include '../config/config.php';
include '../includes/get_universities.php';
include '../includes/user/get_bills.php';
include '../includes/user/nav.php';
include '../includes/user/profile_functions.php';


$university = get_university($my_details['university']);

// Get campaigns and stats
$campaigns = getCampaignsByUserId($_SESSION['user_id']);
$campaign_stats = getCampaignStats($campaigns);
$user_stats = getUserStats($_SESSION['user_id']);
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
            <h2>₦<?php echo  number_format($my_details['balance'],2); ?></h2>
            <p>Balance </p>
        </div>
        <div class="card">
            <h2><?php echo $user_stats['active_campaigns']; ?></h2>
            <p>Active Campaigns</p>
        </div>
        <div class="card">
            <h2><?php echo $user_stats['total_bills']; ?></h2>
            <p>Pending Bills</p>
        </div>
        <div class="card">
            <h2>₦<?php echo number_format($campaign_stats['total_raised'], 2); ?></h2>
            <p>Total Raised</p>
        </div>
    </div>
    <section class="chart-section">
            <div class="chart-container">
                <canvas id="fundraisingChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="billPaymentChart"></canvas>
            </div>
        </section>
    <section class="discover-campaigns">
        <div class="discover-header">
            <div>
                <h2 class="discover-title">Support Student Dreams</h2>
                <p class="discover-subtitle">Help fellow students bring their projects to life</p>
            </div>
            <a href="./discover" class="view-all">View More</a>
        </div>
        <div class="campaign-scroll">
            <div class="campaign-cards">
                <?php

                $discover_campaigns = getDiscoverCampaigns($_SESSION['user_id']);
                echo displayDiscoverCampaigns($discover_campaigns);
                ?>
            </div>
        </div>
    </section>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   $(document).ready(function() {
    $.ajax({
        url: '../includes/user/fetch_charts_data.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Fundraising Chart
            const fundraisingCtx = document.getElementById('fundraisingChart').getContext('2d');
            const fundraisingData = {
                labels: data.fundraising.map(item => `Month ${item.month}`),
                datasets: [{
                    label: 'Total Fundraising Amount',
                    data: data.fundraising.map(item => item.total_raised),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            };

            new Chart(fundraisingCtx, {
                type: 'bar',
                data: fundraisingData,
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Fundraising Performance'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Amount Raised'
                            }
                        }
                    }
                }
            });

            // Bill Payment Chart
            const billCtx = document.getElementById('billPaymentChart').getContext('2d');
            const billData = {
                labels: data.billPayments.map(item => `Month ${item.month}`),
                datasets: [{
                    label: 'Total Bill Payments',
                    data: data.billPayments.map(item => item.total_paid),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            };

            new Chart(billCtx, {
                type: 'line',
                data: billData,
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Bill Payments'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Paid'
                            }
                        }
                    }
                }
            });
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
});

</script>

<?php
$js1 = "overview";
include '../includes/user/footer.php';
?>