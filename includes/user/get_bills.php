<?php
function getBillsByDepartment($department, $user_id)
{
    global $conn;

    $query = "SELECT b.*, 
              p.amount_paid, 
              p.status as payment_status,
              p.last_payment_date,
              DATEDIFF(b.end_date, CURRENT_DATE()) as days_remaining
              FROM bills b
              LEFT JOIN payments p ON b.id = p.bill_id AND p.student_id = ?
              WHERE b.department = ?
              AND b.end_date >= CURRENT_DATE()
              ORDER BY b.end_date ASC";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $user_id, $department);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

function displayBillsSection($bills)
{
    $output = '';

    if (empty($bills)) {
        return '<div class="empty-state">No outstanding bills found</div>';
    }

    foreach ($bills as $bill) {
        $badge_class = 'badge-danger';
        $status = 'Unpaid';
        $amount_display = '₦' . number_format($bill['price'], 2);

        if (isset($bill['payment_status'])) {
            switch ($bill['payment_status']) {
                case 'Paid':
                    $badge_class = 'badge-success';
                    $status = 'Paid';
                    break;
                case 'Partially Paid':
                    $badge_class = 'badge-info';
                    $status = 'Partially Paid';
                    $amount_display .= ' (₦' . number_format($bill['amount_paid'], 2) . ' paid)';
                    break;
            }
        }

        $output .= sprintf(
            '
            <div class="campaign-card">
                <a href="bill.php?id=%d" class="campaign-header">
                    <div>
                        <div class="campaign-title">%s</div>
                        <div class="campaign-meta">Due in %d days</div>
                    </div>
                    <span class="badge %s">%s</span>
                </a>
                <div class="campaign-meta">
                    Amount: %s
                </div>
            </div>
        ',
            $bill['id'],
            htmlspecialchars($bill['name']),
            $bill['days_remaining'],
            $badge_class,
            $status,
            $amount_display
        );
    }

    return $output;
}

function getBillDetails($bill_id, $user_id)
{
    global $conn;

    $query = "SELECT b.*, 
              p.amount_paid, 
              p.status as payment_status,
              p.last_payment_date,
              p.reference_id,
              c.fullname as creator_name,
              DATEDIFF(b.end_date, CURRENT_DATE()) as days_remaining
              FROM bills b
              LEFT JOIN payments p ON b.id = p.bill_id AND p.student_id = ?
              LEFT JOIN creators c ON b.creator_id = c.id
              WHERE b.id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $bill_id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}
