
<?php
//Function to get user details
function getUserDetails(string $email): array
{
    global $conn;

    if (strpos($email, "@")) {
        $query = "SELECT * FROM users WHERE email = ?";
    } else {
        $query = "SELECT * FROM users WHERE id = ?";
    }
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    return $data;
}
function getCampaignsByUserId($user_id)
{
    global $conn;
    $sql = "SELECT c.*, 
            (SELECT COUNT(*) FROM donations WHERE campaign_id = c.id) as donor_count,
            (SELECT SUM(amount) FROM donations WHERE campaign_id = c.id) as total_donations
            FROM campaigns c 
            WHERE c.uid = ? 
            ORDER BY c.created_at DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

function displayCampaignSection($campaigns)
{
    global $conn;
    $output = '';

    if ($campaigns->num_rows > 0) {
        while ($campaign = $campaigns->fetch_assoc()) {
            // Calculate progress percentage
            $progress = ($campaign['amount_raised'] / $campaign['goal_amount']) * 100;
            $progress = min(100, $progress); // Cap at 100%

            // Format the dates
            $created_date = new DateTime($campaign['created_at']);
            $now = new DateTime();
            $interval = $created_date->diff($now);
            $time_ago = formatTimeAgo($interval);

            // Determine badge class
            $badge_class = ($campaign['status'] === 'completed') ? 'badge-success' : 'badge-warning';
            $status_text = ucfirst($campaign['status']);

            $output .= sprintf(
                '
                <div class="campaign-card" onclick="window.location.href=\'campaign?id=%d\'">
                    <div class="campaign-header">
                        <div>
                            <div class="campaign-title">%s</div>
                            <div class="campaign-meta">Created %s</div>
                        </div>
                        <span class="badge %s">%s</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: %d%%"></div>
                    </div>
                    <div class="campaign-stats">
                        <span>₦%s raised of ₦%s</span>
                        <span>%d donors</span>
                    </div>
                </div>',
                $campaign['id'],
                htmlspecialchars($campaign['title']),
                $time_ago,
                $badge_class,
                $status_text,
                $progress,
                number_format($campaign['amount_raised'], 2),
                number_format($campaign['goal_amount'], 2),
                $campaign['donor_count']
            );
        }
    } else {
        $output .= '<div class="campaign-card">
            <div class="campaign-header">
                <div>
                    <div class="campaign-title">No campaigns yet</div>
                    <div class="campaign-meta">Create your first campaign to get started</div>
                </div>
            </div>
        </div>';
    }

    return $output;
}

function formatTimeAgo($interval)
{
    if ($interval->y >= 1) return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
    if ($interval->m >= 1) return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
    if ($interval->d >= 7) return floor($interval->d / 7) . ' week' . (floor($interval->d / 7) > 1 ? 's' : '') . ' ago';
    if ($interval->d >= 1) return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
    if ($interval->h >= 1) return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
    if ($interval->i >= 1) return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
    return 'just now';
}

function getCampaignStats($campaigns)
{
    global $conn;
    $stats = [
        'total_raised' => 0,
        'active_campaigns' => 0
    ];

    if ($row = $campaigns->fetch_assoc()) {
        $stats['total_raised'] = $row['total_raised'] ?? 0;
        $stats['active_campaigns'] = $row['active_campaigns'] ?? 0;
    }

    $campaigns->data_seek(0); // Reset pointer for later use
    return $stats;
}

function generateUniqueCode()
{
    // Generate a secure random string of bytes and convert to hexadecimal
    $randomString = bin2hex(random_bytes(5)); // 10 characters in hexadecimal
    // Construct the code in 3-character segments
    $code = strtoupper(substr($randomString, 0, 3) . '-' . substr($randomString, 3, 3) . '-' . substr($randomString, 6, 3) . '-' . substr($randomString, 9, 3));
    return $code;
}
function getDiscoverCampaigns($user_id, $limit = 6)
{
    global $conn;

    $query = "SELECT c.*, u.department, u.university 
              FROM campaigns c 
              JOIN users u ON c.uid = u.id 
              WHERE c.uid != ? 
              AND c.status = 'active' 
              AND c.end_date >= CURRENT_DATE 
              ORDER BY c.created_at DESC 
              LIMIT ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

function displayDiscoverCampaigns($campaigns)
{
    $output = '';

    foreach ($campaigns as $campaign) {
        $progress = ($campaign['amount_raised'] / $campaign['goal_amount']) * 100;
        $progress = min(100, round($progress, 1));

        $output .= '
        <div class="discover-card" onclick="window.location.href=\'campaign?id='.$campaign['id'].'\'">
            <img src="../assets/images/campaigns/' . htmlspecialchars($campaign['image1']) . '" alt="Campaign Image" class="campaign-image">
            <div class="campaign-info">
                <h3>' . htmlspecialchars($campaign['title']) . '</h3>
                <p class="campaign-description">' . htmlspecialchars($campaign['description']) . '</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: ' . $progress . '%;"></div>
                </div>
                <div class="campaign-stats">
                    <span>₦' . number_format($campaign['amount_raised'], 2) . ' raised</span>
                    <span>' . $progress . '%</span>
                </div>
                <div class="campaign-meta">
                    <span>' . htmlspecialchars($campaign['department']) . '</span>
                </div>
            </div>
        </div>';
    }

    return $output;
}


?>