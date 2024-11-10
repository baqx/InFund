
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
    $sql = "SELECT c.id, c.title, c.goal_amount, c.amount_raised, c.status, c.created_at,
            (SELECT COUNT(*) FROM donations WHERE campaign_id = c.id) as donor_count,
            (SELECT SUM(amount_raised) FROM campaigns WHERE uid = c.uid) as total_raised,
            (SELECT COUNT(*) FROM campaigns WHERE uid = c.uid AND status = 'active') as active_campaigns
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
    $stats = [];
    if ($row = $campaigns->fetch_assoc()) {
        $stats['total_raised'] = $row['total_raised'] ?? 0;
        $stats['active_campaigns'] = $row['active_campaigns'] ?? 0;
    }
    $campaigns->data_seek(0); // Reset pointer for later use
    return $stats;
}
?>