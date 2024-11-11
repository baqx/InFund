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

</div>

<script>

    // Animate progress bars on scroll
    const progressBars = document.querySelectorAll('.progress-fill');
    const animateProgressBars = () => {
        progressBars.forEach(bar => {
            const rect = bar.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom >= 0;

            if (isVisible) {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 100);
            }
        });
    };

    // Initial animation
    window.addEventListener('load', animateProgressBars);
    // Animate on scroll
    window.addEventListener('scroll', animateProgressBars);

    // Add smooth scrolling for mobile
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
                // Close mobile menu after clicking
                if (window.innerWidth <= 768) {
                    sidenav.classList.remove('open');
                    menuIcon.classList.remove('fa-times');
                    menuIcon.classList.add('fa-bars');
                }
            }
        });
    });
</script>
</body>

</html>