<?php
// bills.php - Main bills listing page
session_start();
include '../config/config.php';

$page_title = "Bills Management";
$page = "Bills";
include '../includes/admin/nav.php';

// Get all bills created by admin
$stmt = $conn->prepare("
    SELECT b.*, COALESCE(SUM(p.amount_paid), 0) as total_collected,
    COUNT(DISTINCT p.id) as payment_count
    FROM bills b 
    LEFT JOIN payments p ON p.bill_id = b.id
    WHERE b.creator_id = ? 
    GROUP BY b.id
    ORDER BY b.created_at DESC
");
$stmt->bind_param("i", $_SESSION['admin_id']);
$stmt->execute();
$result = $stmt->get_result();
$bills = $result->fetch_all(MYSQLI_ASSOC);
?>

<style>
    .bills-container {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .bills-table {
        width: 100%;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .bills-table th,
    .bills-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .bills-table th {
        background: #f8f9fa;
        font-weight: 600;
    }

    .bills-table tr:hover {
        background: #f8f9fa;
        cursor: pointer;
    }

    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
    }

    .status-active {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .status-expired {
        background: #ffebee;
        color: #c62828;
    }

    .btn {
        padding: 0.8rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-primary {
        background: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background: #45a049;
    }
</style>
</head>
<main class="main-content">
    <div class="bills-container">
        <div class="page-header">
            <h1>Bills Management</h1>
            <a href="create-bill.php" class="btn btn-primary">Create New Bill</a>
        </div>

        <table class="bills-table">
            <thead>
                <tr>
                    <th>Bill Name</th>
                    <th>Amount</th>
                    <th>Total Collected</th>
                    <th>Payments</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bills as $bill) : ?>
                    <tr onclick="window.location='bill-details.php?id=<?php echo $bill['id']; ?>'">
                        <td><?php echo htmlspecialchars($bill['name']); ?></td>
                        <td>₦<?php echo number_format($bill['price'], 2); ?></td>
                        <td>₦<?php echo number_format($bill['total_collected'], 2); ?></td>
                        <td><?php echo $bill['payment_count']; ?></td>
                        <td><?php echo date('M j, Y', strtotime($bill['start_date'])); ?></td>
                        <td><?php echo date('M j, Y', strtotime($bill['end_date'])); ?></td>
                        <td>
                            <span class="status-badge <?php echo strtotime($bill['end_date']) < time() ? 'status-expired' : 'status-active'; ?>">
                                <?php echo strtotime($bill['end_date']) < time() ? 'Expired' : 'Active'; ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </ma>

    </html>