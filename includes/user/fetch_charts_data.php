<?php
header('Content-Type: application/json');

session_start();
include '../../config/config.php';

$user_id = $_SESSION['user_id'];

// Fetch fundraising data
$fundraisingQuery = "
    SELECT 
        MONTH(created_at) as month, 
        SUM(amount_raised) as total_raised 
    FROM campaigns 
    WHERE uid = '$user_id' 
    GROUP BY MONTH(created_at)
    ORDER BY month
";
$fundraisingResult = mysqli_query($conn, $fundraisingQuery);

$fundraisingData = [];
if ($fundraisingResult) {
    while ($row = mysqli_fetch_assoc($fundraisingResult)) {
        $fundraisingData[] = $row;
    }
}

// Fetch bill payment data
$billQuery = "
    SELECT 
        MONTH(created_at) as month, 
        SUM(total_amount) as total_paid 
    FROM bill_invoice 
    WHERE uid = '$user_id' AND status = 'Paid'
    GROUP BY MONTH(created_at)
    ORDER BY month
";
$billResult = mysqli_query($conn, $billQuery);

$billData = [];
if ($billResult) {
    while ($row = mysqli_fetch_assoc($billResult)) {
        $billData[] = $row;
    }
}

// Close the database connection
mysqli_close($conn);

echo json_encode([
    'fundraising' => $fundraisingData,
    'billPayments' => $billData
]);
