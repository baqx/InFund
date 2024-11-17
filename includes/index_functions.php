<?php
// Index Page Campaigns
function getHomepageCampaigns($limit = 5)
{
    global $conn;

    $query = "SELECT c.*, u.department, u.university, 
              DATEDIFF(c.end_date, CURRENT_DATE) as days_left,
              (SELECT COUNT(*) FROM donations WHERE campaign_id = c.id) as donors_count
              FROM campaigns c 
              JOIN users u ON c.uid = u.id 
              WHERE c.status = 'active' 
              AND c.end_date >= CURRENT_DATE 
              ORDER BY c.created_at DESC 
              LIMIT ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

// Format currency in Naira
function formatNaira($amount)
{
    return '₦' . number_format($amount, 2);
}

// Calculate campaign progress
function calculateProgress($raised, $goal)
{
    return min(100, round(($raised / $goal) * 100, 1));
}


