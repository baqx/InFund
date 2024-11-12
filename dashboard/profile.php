<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$page_title = "Profile";
$page = "Profile";
$css1="profile";
include '../config/config.php';
include '../includes/get_universities.php';
include '../includes/user/profile_functions.php';
include '../includes/user/nav.php';

$university = get_university($my_details['university']);
$user_stats = getUserStats($_SESSION['user_id']);
?>

<main class="main-content">
    <div class="profile-header">
        <div class="profile-avatar">
            <?php echo strtoupper(substr($my_details['fullname'], 0, 1)); ?>
        </div>
        <div class="profile-info">
            <h1><?php echo $my_details['fullname']; ?></h1>
            <p><i class="fas fa-envelope"></i> <?php echo $my_details['email']; ?></p>
            <p><i class="fas fa-phone"></i> <?php echo $my_details['phone']; ?></p>
        </div>
        <a href="edit-profile.php" class="edit-profile-btn">
            <i class="fas fa-edit"></i> Edit Profile
        </a>
    </div>

    <div class="profile-grid">
        <div class="profile-section">
            <h2>Personal Information</h2>
            <div class="info-card">
                <div class="info-item">
                    <span class="label">Username</span>
                    <span class="value"><?php echo $my_details['username']; ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Date of Birth</span>
                    <span class="value"><?php echo $my_details['dob']; ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Gender</span>
                    <span class="value"><?php echo $my_details['gender']; ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Location</span>
                    <span class="value"><?php echo $my_details['state'] . ', ' . $my_details['country']; ?></span>
                </div>
            </div>
        </div>

        <div class="profile-section">
            <h2>Academic Information</h2>
            <div class="info-card">
                <div class="info-item">
                    <span class="label">University</span>
                    <span class="value"><?php echo $university[0]['name']; ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Faculty</span>
                    <span class="value"><?php echo $my_details['faculty']; ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Department</span>
                    <span class="value"><?php echo $my_details['department']; ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Matric Number</span>
                    <span class="value"><?php echo $my_details['matric_no']; ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <i class="fas fa-wallet"></i>
            <div class="stat-info">
                <h3>Current Balance</h3>
                <p>₦<?php echo number_format($my_details['balance'], 2); ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-hand-holding-usd"></i>
            <div class="stat-info">
                <h3>Total Received Donations</h3>
                <p>₦<?php echo number_format($user_stats['total_donations'], 2); ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-bullhorn"></i>
            <div class="stat-info">
                <h3>Active Campaigns</h3>
                <p><?php echo $user_stats['active_campaigns']; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-receipt"></i>
            <div class="stat-info">
                <h3>Total Bills</h3>
                <p><?php echo $user_stats['total_bills']; ?></p>
            </div>
        </div>
    </div>
</main>

<?php 
$js1 = "profile";
include '../includes/user/footer.php'; 
?>