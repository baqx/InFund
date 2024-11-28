<?php
//Campaign badge
function getBadgeClass($status)
{
    switch (strtolower($status)) {
        case 'active':
            return 'badge-success';  // Green for active campaigns
        case 'completed':
            return 'badge-info';     // Blue for completed campaigns
        case 'draft':
            return 'badge-warning';  // Yellow/Orange for draft campaigns
        case 'cancelled':
            return 'badge-danger';   // Red for cancelled campaigns
        default:
            return 'badge-secondary'; // Gray for any undefined status
    }
}
// campaign_functions.php

function getCampaignDetails($campaign_id, $user_id)
{
    global $conn;

    $query = "SELECT c.*, 
              (SELECT COUNT(DISTINCT d.id) FROM donations d WHERE d.campaign_id = c.id) as donor_count,
              (SELECT SUM(d.amount) FROM donations d WHERE d.campaign_id = c.id) as total_raised
              FROM campaigns c 
              WHERE c.id = ? AND c.uid = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $campaign_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return null;
    }

    return $result->fetch_assoc();
}

function getDonationsByDate($campaign_id)
{
    global $conn;

    $query = "SELECT DATE(created_at) as donation_date, 
              COUNT(*) as donation_count, 
              SUM(amount) as daily_amount 
              FROM donations 
              WHERE campaign_id = ? 
              GROUP BY DATE(created_at) 
              ORDER BY donation_date ASC";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $campaign_id);
    $stmt->execute();
    return $stmt->get_result();
}

function getTopDonors($campaign_id, $limit = 5)
{
    global $conn;

    $query = "SELECT donor_name, amount, created_at 
              FROM donations 
              WHERE campaign_id = ? 
              ORDER BY amount DESC 
              LIMIT ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $campaign_id, $limit);
    $stmt->execute();
    return $stmt->get_result();
}

function getDonationStats($campaign_id)
{
    global $conn;

    $query = "SELECT 
              COUNT(*) as total_donations,
              AVG(amount) as avg_donation,
              MAX(amount) as largest_donation,
              MIN(amount) as smallest_donation
              FROM donations 
              WHERE campaign_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $campaign_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
