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

$page_title = $campaign['title'];
$page = "Campaigns";
$css1 = "campaign";
if (isset($_SESSION["user_id"])) {

    include '../includes/user/nav.php';
} else {
    include '../config/config.php';
    include '../config/secrets.php';
    include '../includes/user/functions.php';
}

$uniquecode = generateUniqueCode();
$reference_id = "CAMPAIGN-$uniquecode";
?>
<?php if (!isset($_SESSION['user_id'])) { ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($campaign['title']); ?> - INfund</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="../assets/css/colors.css">
        <link rel="stylesheet" href="../assets/css/user/campaign.css">
        <link rel="stylesheet" href="../assets/css/landing/nav_only.css">
    </head>
    <!-- Navigation -->
    <nav>
        <div class="nav-content">
            <div class="logo">
                <img src='../assets/images/static/logo_text.png' alt="InFund" />
            </div>
            <button class="menu-button" aria-label="Toggle menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </button>
            <ul class="nav-links">
                <li><a href="../#home">Home</a></li>
                <li><a href="../#campaigns">Campaigns</a></li>
                <li><a href="../#features">Features</a></li>
                <li><a href="../login"><button class="btn-primary">Login</button></a></li>
            </ul>
        </div>
    </nav>
    <div class="overlay"></div>

<?php } ?>
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
        <form id="donationForm" method="POST" action="">
            <input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>">
            <input type="hidden" name="amount" id="hiddenAmount">
            <input type="text" name="donor_name" class="donation-input" placeholder="Your Name (Optional)">
            <input type="email" name="email" class="donation-input" value="<?php if (isset($_SESSION['user_id'])) {
                                                                                echo $my_details["email"];
                                                                            } ?>" placeholder="Email Address" required <?php if (isset($_SESSION['user_id'])) {
                                                                                                                            echo "disabled";
                                                                                                                        } ?>>
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
<script src="../assets/js/landing/nav.js"></script>
<script>
    // Format name into first and last name
    function formatName(fullName) {
        const names = fullName.trim().split(' ');
        return {
            firstName: names[0] || '',
            lastName: names.slice(1).join(' ') || names[0] // Use first name as last name if no last name provided
        };
    }

    // Initialize the donation modal
    function openDonateModal() {
        const amount = document.querySelector('.donation-input').value;
        if (!amount || amount < 100) {
            alert('Please enter a valid amount (minimum ₦100)');
            return;
        }

        document.getElementById('modalAmount').textContent = '₦' + Number(amount).toLocaleString();
        document.getElementById('hiddenAmount').value = amount;
        document.getElementById('donateModal').style.display = 'flex';
    }

    // Close the donation modal
    function closeDonateModal() {
        document.getElementById('donateModal').style.display = 'none';
    }

    // Handle form submission
    document.getElementById('donationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const amount = document.getElementById('hiddenAmount').value;
        const donorName = document.querySelector('input[name="donor_name"]').value || 'Anonymous';
        const email = document.querySelector('input[name="email"]').value;
        const campaignId = document.querySelector('input[name="campaign_id"]').value;

        const names = formatName(donorName);

        // Construct the additional details object
        const additionalDetails = JSON.stringify({
            campaign_id: campaignId,
            donor_name: donorName
        });

        // Construct the payment URL
        const paymentUrl = new URL('https://business.payaza.africa/payment-page/');
        const params = new URLSearchParams({
            merchant_key: '<?php echo $PAYAZA_API_KEY; ?>',
            connection_mode: 'Test',
            checkout_amount: amount,
            currency_code: 'NGN',
            email_address: email,
            first_name: names.firstName,
            last_name: names.lastName,
            phone_number: '', // Optional, can be left empty
            transaction_reference: '<?php echo $reference_id; ?>',
            additional_details: additionalDetails,
            redirect_url: `${window.location.origin}/infund/includes/user/process_donation.php?ref=<?php echo $reference_id; ?>&name=${encodeURIComponent(names.firstName + ' ' + names.lastName)}&email=${encodeURIComponent(email)}&id=${encodeURIComponent(campaignId)}`
        });

        // Redirect to payment page
        window.location.href = `${paymentUrl}?${params.toString()}`;
    });

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('donateModal');
        if (event.target === modal) {
            closeDonateModal();
        }
    }

    // Share functionality
    const shareButtons = document.querySelectorAll(".share-button");
    shareButtons.forEach((button) => {
        button.addEventListener("click", async () => {
            const campaignTitle = document.querySelector(".campaign-title").textContent;
            const campaignUrl = window.location.href;
            const shareText = `Support ${campaignTitle} on INFund: ${campaignUrl}`;

            if (button.querySelector(".fa-whatsapp")) {
                window.open(
                    `https://wa.me/?text=${encodeURIComponent(shareText)}`,
                    "_blank"
                );
            } else if (button.querySelector(".fa-twitter")) {
                window.open(
                    `https://twitter.com/intent/tweet?text=${encodeURIComponent(
          shareText
        )}`,
                    "_blank"
                );
            } else {
                try {
                    await navigator.share({
                        title: campaignTitle,
                        text: "Support my education campaign on INFund",
                        url: campaignUrl,
                    });
                } catch (err) {
                    prompt("Copy this link to share:", campaignUrl);
                }
            }
        });
    });
</script>