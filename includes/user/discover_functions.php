<?php

function getAllDiscoverActiveCampaigns($user_id, $page = 1, $per_page = 12, $filters = []) {
    global $conn;
    
    $offset = ($page - 1) * $per_page;
    
    $where_clauses = ["c.uid != ?", "c.status = 'active'", "c.end_date >= CURRENT_DATE"];
    $params = [$user_id];
    $types = "i";
    
    // Add filters if they exist
    if (!empty($filters['university'])) {
        $where_clauses[] = "u.university = ?";
        $params[] = $filters['university'];
        $types .= "s";
    }
    
    if (!empty($filters['department'])) {
        $where_clauses[] = "u.department = ?";
        $params[] = $filters['department'];
        $types .= "s";
    }
    
    if (!empty($filters['search'])) {
        $search_term = "%" . $filters['search'] . "%";
        $where_clauses[] = "(c.title LIKE ? OR c.description LIKE ?)";
        $params[] = $search_term;
        $params[] = $search_term;
        $types .= "ss";
    }
    
    $where_statement = implode(" AND ", $where_clauses);
    
    $query = "SELECT c.*, u.department, u.university,
              DATEDIFF(c.end_date, CURRENT_DATE) as days_left 
              FROM campaigns c 
              JOIN users u ON c.uid = u.id 
              WHERE {$where_statement}
              ORDER BY c.created_at DESC 
              LIMIT ? OFFSET ?";
    
    $params[] = $per_page;
    $params[] = $offset;
    $types .= "ii";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getTotalCampaignsCount($user_id, $filters = []) {
    global $conn;
    
    $where_clauses = ["c.uid != ?", "c.status = 'active'", "c.end_date >= CURRENT_DATE"];
    $params = [$user_id];
    $types = "i";
    
    if (!empty($filters['university'])) {
        $where_clauses[] = "u.university = ?";
        $params[] = $filters['university'];
        $types .= "s";
    }
    
    if (!empty($filters['department'])) {
        $where_clauses[] = "u.department = ?";
        $params[] = $filters['department'];
        $types .= "s";
    }
    
    if (!empty($filters['search'])) {
        $search_term = "%" . $filters['search'] . "%";
        $where_clauses[] = "(c.title LIKE ? OR c.description LIKE ?)";
        $params[] = $search_term;
        $params[] = $search_term;
        $types .= "ss";
    }
    
    $where_statement = implode(" AND ", $where_clauses);
    
    $query = "SELECT COUNT(*) as total 
              FROM campaigns c 
              JOIN users u ON c.uid = u.id 
              WHERE {$where_statement}";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    return $row['total'];
}

function displayDiscoverPageCampaigns($campaigns) {
    $output = '';
    
    foreach ($campaigns as $campaign) {
        $progress = ($campaign['amount_raised'] / $campaign['goal_amount']) * 100;
        $progress = min(100, round($progress, 1));
        
        $days_left = max(0, $campaign['days_left']);
        $days_text = $days_left == 0 ? "Last day" : "$days_left days left";
        
        $output .= '
        <div class="discover-card">
            <img src="../assets/images/campaigns/' . htmlspecialchars($campaign['image1']) . '" alt="Campaign Image" class="campaign-image">
            <div class="campaign-content">
                <div class="campaign-info">
                    <h3 class="campaign-title">' . htmlspecialchars($campaign['title']) . '</h3>
                    <p class="campaign-description">' . htmlspecialchars($campaign['description']) . '</p>
                    <div class="campaign-meta">
                        <span>' . htmlspecialchars($campaign['department']) . '</span>
                        <span>' . htmlspecialchars($campaign['university']) . '</span>
                    </div>
                </div>
                <div class="campaign-stats">
                    <div class="progress-container">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: ' . $progress . '%;"></div>
                        </div>
                        <div class="campaign-stats">
                            <span>₦' . number_format($campaign['amount_raised'], 2) . ' raised</span>
                            <span>' . $progress . '%</span>
                        </div>
                    </div>
                    <div class="campaign-footer">
                        <span class="time-left">' . $days_text . '</span>
                        <a href="campaign.php?id=' . $campaign['id'] . '" class="support-btn">Support</a>
                    </div>
                </div>
            </div>
        </div>';
    }
    
    return $output;
}
?>