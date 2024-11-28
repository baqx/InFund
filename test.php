
<?php
include './config/config.php';
include './config/secrets.php';
include './includes/user/bill_emails.php';
require_once './vendor/autoload.php';
$billDetails = [
    'id' => 1,
    'name' => 'Electricity Bill',
    'price' => 15000
];

$paymentDetails = [
    'amount_paid' => 15000,
    'payment_status' => 'Paid',
    'reference_id' => 'REF12345678',
    'last_payment_date' => '2024-11-27'
];

sendReceiptEmail('baqee20072007@gmail.com', 'Adegbola Abdulbaqee', $billDetails, $paymentDetails);
