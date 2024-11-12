<?php
session_start();
require_once '../config/config.php';

// Function to get campaign details
function getCampaignDetails($campaign_id)
{
    global $conn;
    $query = "SELECT c.*, u.fullname, u.department, u.faculty 
              FROM campaigns c 
              JOIN users u ON c.uid = u.id 
              WHERE c.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $campaign_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Function to get recent donors
function getRecentDonors($campaign_id, $limit = 3)
{
    global $conn;
    $query = "SELECT donor_name, amount, created_at 
              FROM donations 
              WHERE campaign_id = ? 
              ORDER BY created_at DESC 
              LIMIT ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $campaign_id, $limit);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Get campaign ID from URL
$campaign_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$campaign_id) {
    header("Location: campaigns.php");
    exit();
}

// Fetch campaign details
$campaign = getCampaignDetails($campaign_id);
if (!$campaign) {
    header("Location: campaigns.php");
    exit();
}

// Calculate days left
$end_date = new DateTime($campaign['end_date']);
$today = new DateTime();
$days_left = $today->diff($end_date)->days;

// Calculate progress percentage
$progress = ($campaign['amount_raised'] / $campaign['goal_amount']) * 100;

$page_title = "Campaign Information";
$page = "Campaigns";
$css1 = "campaign";
include '../includes/user/nav.php';
?>

<main class="main-content">
    <div class="campaign-detail-header">
        <h1 class="campaign-title"><?php echo htmlspecialchars($campaign['title']); ?></h1>
        <div class="campaign-meta">
            <div class="meta-item">
                <i class="fas fa-user"></i>
                <span><?php echo htmlspecialchars($campaign['fullname']); ?></span>
            </div>
            <div class="meta-item">
                <i class="fas fa-university"></i>
                <span><?php echo htmlspecialchars($campaign['department']); ?></span>
            </div>
            <div class="meta-item">
                <i class="fas fa-calendar"></i>
                <span><?php echo $days_left; ?> days left</span>
            </div>
            <div class="meta-item">
                <i class="fas fa-users"></i>
                <span><?php echo count(getRecentDonors($campaign_id, 1000)); ?> donors</span>
            </div>
        </div>

        <div class="progress-section">
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?php echo min(100, $progress); ?>%"></div>
            </div>
            <div class="progress-stats">
                <span>₦<?php echo number_format($campaign['amount_raised'], 2); ?> raised</span>
                <span>₦<?php echo number_format($campaign['goal_amount'], 2); ?> goal</span>
            </div>
        </div>

        <div class="share-buttons">
            <button class="share-button">
                <i class="fas fa-share"></i>
                Share
            </button>
            <button class="share-button">
                <i class="fab fa-whatsapp"></i>
                WhatsApp
            </button>
            <button class="share-button">
                <i class="fab fa-twitter"></i>
                Twitter
            </button>
        </div>
    </div>

    <div class="campaign-content">
        <div class="campaign-description">
            <h2>About This Campaign</h2>
            <div class="description-content">
                <?php echo nl2br(htmlspecialchars($campaign['description'])); ?>
            </div>

            <?php if ($campaign['impact']) : ?>
                <h2>Impact</h2>
                <div class="impact-content">
                    <?php echo nl2br(htmlspecialchars($campaign['impact'])); ?>
                </div>
            <?php endif; ?>

            <?php if ($campaign['importance']) : ?>
                <h2>Why This Is Important</h2>
                <div class="importance-content">
                    <?php echo nl2br(htmlspecialchars($campaign['importance'])); ?>
                </div>
            <?php endif; ?>

            <?php if ($campaign['image1'] || $campaign['image2'] || $campaign['image3'] || $campaign['image4']) : ?>
                <h2>Gallery</h2>
                <div class="campaign-gallery">
                    <?php
                    for ($i = 1; $i <= 4; $i++) {
                        $image = $campaign['image' . $i];
                        if ($image) {
                            echo '<div class="gallery-item">';
                            echo '<img src="../assets/images/campaigns/' . htmlspecialchars($image) . '" alt="Campaign Image ' . $i . '">';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            <?php endif; ?>

            <div class="donor-list">
                <h2>Recent Donors</h2>
                <?php
                $recent_donors = getRecentDonors($campaign_id);
                foreach ($recent_donors as $donor) :
                ?>
                    <div class="donor-card">
                        <div class="donor-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="donor-info">
                            <div class="donor-name"><?php echo htmlspecialchars($donor['donor_name']); ?></div>
                            <div class="donation-amount">₦<?php echo number_format($donor['amount'], 2); ?></div>
                            <div class="donation-time"><?php echo timeAgo($donor['created_at']); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="donate-section">
            <h2>Support This Campaign</h2>
            <p style="margin: 1rem 0; color: #666;">Help <?php echo htmlspecialchars($campaign['fullname']); ?> reach their goal by making a donation.</p>
            <input type="number" class="donation-input" placeholder="Enter amount (₦)" min="100">
            <button class="donate-button" onclick="openDonateModal()">Donate Now</button>
        </div>
    </div>
</main>

<!-- Donation Modal -->
<div class="modal" id="donateModal">
    <div class="modal-content">
        <button class="close-modal" onclick="closeDonateModal()">×</button>
        <h2>Complete Your Donation</h2>
        <p style="margin: 1rem 0; color: #666;">You're supporting <?php echo htmlspecialchars($campaign['title']); ?></p>
        <div style="margin: 1.5rem 0;">
            <h3>Amount: <span id="modalAmount">₦0</span></h3>
        </div>
        <form id="donationForm" method="POST" action="../includes/user/process_donation">
            <input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>">
            <input type="hidden" name="amount" id="hiddenAmount">
            <input type="text" name="donor_name" class="donation-input" placeholder="Your Name (Optional)">
            <input type="email" name="email" class="donation-input" placeholder="Email Address" required>
            <button type="submit" class="donate-button">Proceed to Payment</button>
        </form>
    </div>
</div>

<?php
// Helper function for time ago
function timeAgo($timestamp)
{
    $datetime = new DateTime($timestamp);
    $now = new DateTime();
    $interval = $now->diff($datetime);

    if ($interval->y > 0) return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
    if ($interval->m > 0) return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
    if ($interval->d > 0) return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
    if ($interval->h > 0) return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
    if ($interval->i > 0) return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
    return 'just now';
}
?>

<?php
$js1 = "campaign";
include '../includes/user/footer.php';
?>
