<?php
session_start();
include '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    die(json_encode(['error' => 'Unauthorized']));
}

$admin_id = $_SESSION['admin_id'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Items per page
$offset = ($page - 1) * $limit;

// Build the WHERE clause
$where = ["uid = ?"];
$params = [$admin_id];
$types = "i"; // For admin_id

if (isset($_GET['type']) && $_GET['type'] != 'all') {
    $where[] = "type = ?";
    $params[] = $_GET['type'];
    $types .= "s";
}

if (isset($_GET['status']) && $_GET['status'] != 'all') {
    $where[] = "status = ?";
    $params[] = $_GET['status'];
    $types .= "s";
}

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $where[] = "(name LIKE ? OR reference_id LIKE ? OR gateway_reference LIKE ?)";
    $search = "%" . $_GET['search'] . "%";
    $params[] = $search;
    $params[] = $search;
    $params[] = $search;
    $types .= "sss";
}

$where_clause = implode(" AND ", $where);

// Count total records for pagination
$count_query = "SELECT COUNT(*) as total FROM admin_transactions WHERE " . $where_clause;
$stmt = $conn->prepare($count_query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$total_result = $stmt->get_result()->fetch_assoc();
$total_records = $total_result['total'];
$total_pages = ceil($total_records / $limit);

// Get transactions
$query = "SELECT * FROM admin_transactions WHERE " . $where_clause . " 
          ORDER BY timestamp DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
$types .= "ii"; // Add types for LIMIT and OFFSET
$params[] = $limit;
$params[] = $offset;
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$transactions_html = '';
while ($row = $result->fetch_assoc()) {
    $amount_class = $row['transaction_type'] === 'credit' ? 'amount-positive' : 'amount-negative';
    $amount_prefix = $row['transaction_type'] === 'credit' ? '+' : '-';

    // Determine the link URL based on transaction type
    $link_url = '';
    if ($row['type'] === 'bill-payment') {
        $link_url = "bill.php?id=" . $row['type_id'];
    } elseif ($row['type'] === 'donate' || $row['type'] === 'received-donation') {
        $link_url = "campaign.php?id=" . $row['type_id'];
    }

    // Icon class based on transaction type
    $icon_class = '';
    switch ($row['type']) {
        case 'bill-payment':
        case 'bill-funded':
            $icon_class = 'fa-credit-card';
            break;
        case 'donate':
            $icon_class = 'fa-hand-holding-heart';
            break;
        case 'received-donation':
            $icon_class = 'fa-gift';
            break;
    }

    $transactions_html .= '
    <a href="' . ($link_url ? $link_url : 'javascript:void(0)') . '" class="transaction-link">
        <div class="transaction-item">
            <div class="transaction-icon ' . $row['type'] . '">
                <i class="fas ' . $icon_class . '"></i>
            </div>
            <div class="transaction-details">
                <div class="transaction-title">' . htmlspecialchars($row['name']) . '</div>
                <div class="transaction-meta">
                    <span><i class="fas fa-calendar"></i> ' . date('M d, Y', strtotime($row['timestamp'])) . '</span>
                    <span><i class="fas fa-clock"></i> ' . date('H:i', strtotime($row['timestamp'])) . '</span>
                    <span><i class="fas fa-hashtag"></i> ' . ($row['reference_id'] ?? 'N/A') . '</span>
                </div>
            </div>
            <div class="transaction-amount ' . $amount_class . '">
                ' . $amount_prefix . '₦' . number_format($row['amount'], 2) . '
                <span class="transaction-status status-' . $row['status'] . '">' . ucfirst($row['status']) . '</span>
            </div>
        </div>
    </a>';
}

// Generate pagination
$pagination_html = '';
if ($total_pages > 1) {
    $pagination_html .= '<button class="page-button" ' . ($page > 1 ? 'data-page="' . ($page - 1) . '"' : 'disabled') . '><i class="fas fa-chevron-left"></i></button>';

    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == 1 || $i == $total_pages || ($i >= $page - 2 && $i <= $page + 2)) {
            $pagination_html .= '<button class="page-button ' . ($i == $page ? 'active' : '') . '" data-page="' . $i . '">' . $i . '</button>';
        } elseif ($i == $page - 3 || $i == $page + 3) {
            $pagination_html .= '<span class="page-button">...</span>';
        }
    }

    $pagination_html .= '<button class="page-button" ' . ($page < $total_pages ? 'data-page="' . ($page + 1) . '"' : 'disabled') . '><i class="fas fa-chevron-right"></i></button>';
}

echo json_encode([
    'transactions' => $transactions_html,
    'pagination' => $pagination_html,
    'total_pages' => $total_pages
]);

$stmt->close();
$conn->close();
