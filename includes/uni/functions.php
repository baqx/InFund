<?php
function getUniversityDetails(string $email): array
{
    global $conn;

    if (strpos($email, "@")) {
        $query = "SELECT * FROM universities WHERE email = ?";
    } else {
        $query = "SELECT * FROM universities WHERE id = ?";
    }
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    return $data;
}

function getDashboardStats($university_id) {
    global $conn;
    
    // Get total number of students
    $student_query = "SELECT COUNT(*) as total_students FROM users WHERE university = (SELECT abbreviation FROM universities WHERE id = ?)";
    $stmt = $conn->prepare($student_query);
    $stmt->bind_param("i", $university_id);
    $stmt->execute();
    $student_result = $stmt->get_result();
    $total_students = $student_result->fetch_assoc()['total_students'];
    
    // Get total number of active campaigns
    $campaign_query = "SELECT COUNT(*) as total_campaigns FROM campaigns c 
                      JOIN users u ON c.uid = u.id 
                      WHERE u.university = (SELECT abbreviation FROM universities WHERE id = ?) 
                      AND c.status = 'active'";
    $stmt = $conn->prepare($campaign_query);
    $stmt->bind_param("i", $university_id);
    $stmt->execute();
    $campaign_result = $stmt->get_result();
    $total_campaigns = $campaign_result->fetch_assoc()['total_campaigns'];
    
    // Get total amount raised
    $amount_query = "SELECT SUM(amount_raised) as total_raised FROM campaigns c 
                    JOIN users u ON c.uid = u.id 
                    WHERE u.university = (SELECT abbreviation FROM universities WHERE id = ?)";
    $stmt = $conn->prepare($amount_query);
    $stmt->bind_param("i", $university_id);
    $stmt->execute();
    $amount_result = $stmt->get_result();
    $total_raised = $amount_result->fetch_assoc()['total_raised'] ?? 0;
    
    // Get recent campaigns
    $recent_campaigns_query = "SELECT c.*, u.fullname FROM campaigns c 
                             JOIN users u ON c.uid = u.id 
                             WHERE u.university = (SELECT abbreviation FROM universities WHERE id = ?)
                             ORDER BY c.created_at DESC LIMIT 5";
    $stmt = $conn->prepare($recent_campaigns_query);
    $stmt->bind_param("i", $university_id);
    $stmt->execute();
    $recent_campaigns = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    return [
        'total_students' => $total_students,
        'total_campaigns' => $total_campaigns,
        'total_raised' => $total_raised,
        'recent_campaigns' => $recent_campaigns
    ];
}

function getFacultyStats($university_id) {
    global $conn;
    
    $query = "SELECT f.name, COUNT(u.id) as student_count 
              FROM university_faculties f 
              LEFT JOIN users u ON f.name = u.faculty 
              WHERE f.university_id = ? 
              GROUP BY f.name";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $university_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function getRecentBills($university_id) {
    global $conn;
    
    $query = "SELECT b.*, u.fullname 
              FROM bills b 
              JOIN creators u ON b.creator_id = u.id 
              WHERE b.university = (SELECT abbreviation FROM universities WHERE id = ?) 
              ORDER BY b.created_at DESC LIMIT 5";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $university_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}