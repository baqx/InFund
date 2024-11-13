<?php
function getInvoiceDetails($invoice_id)
{
    global $conn;
    $invoice_id = mysqli_real_escape_string($conn, $invoice_id);

    $sql = "SELECT bi.*, b.*, u.fullname, u.email, u.phone 
            FROM bill_invoice bi 
            JOIN bills b ON bi.bill_id = b.id 
            JOIN users u ON bi.uid = u.id 
            WHERE bi.id = '$invoice_id'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

function formatAmount($amount)
{
    return '₦' . number_format($amount, 2);
}

function generatePaymentReference()
{
    return 'PL' . time() . rand(1000, 9999);
}
