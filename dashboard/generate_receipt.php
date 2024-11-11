<?php
session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    // Redirect to login page if user is not logged in
    header("Location: ../login");
}
require_once '../config/config.php';
include '../includes/user/functions.php';
include '../includes/user/get_bills.php';
require '../includes/fpdf/fpdf.php';

// Fetch user details
$my_details = getUserDetails($_SESSION['user_id']); // Fetch user details

$bill_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = $_SESSION['user_id'] ?? 0;

if (!$bill_id || !$user_id) {
    header("Location: bills.php");
    exit();
}

$bill = getBillDetails($bill_id, $user_id);
if (!$bill) {
    header("Location: bills.php");
    exit();
}

class PDFReceipt extends FPDF
{
    function Header()
    {
        $this->Image('../assets/images/static/logo_text.png', 10, 6, 30); // Logo

        // Title (no background color)
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(44, 62, 80); // Text color from --text-color
        $this->Cell(0, 20, 'Payment Receipt', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-30);
        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(150, 150, 150);
        $this->Cell(0, 10, 'Thank you for your payment!', 0, 1, 'C');
        $this->Cell(0, 10, 'For inquiries, contact support@example.com or +1234567890', 0, 1, 'C');
    }

    function BillDetails($bill, $my_details)
    {
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(44, 62, 80); // Text color from --text-color

        // User Information
        $this->SetFillColor(247, 249, 252); // Background color for section header
        $this->Cell(0, 8, ' Customer Information', 0, 1, 'L', true);
        $this->Ln(3);
        $userFields = [
            'Full Name' => $my_details['fullname'],
            'Email' => $my_details['email'],
            'Phone' => $my_details['phone'],
            'University' => $my_details['university'],
            'Faculty' => $my_details['faculty'],
            'Department' => $my_details['department'],
            'Matric No' => $my_details['matric_no'],
        ];
        foreach ($userFields as $label => $value) {
            $this->Cell(50, 8, $label . ':', 0, 0);
            $this->Cell(100, 8, $value, 0, 1);
        }
        $this->Ln(5);

        // Bill Information Section
        $this->SetFillColor(247, 249, 252); // Background color for section header
        $this->Cell(0, 8, ' Bill Information', 0, 1, 'L', true);
        $this->Ln(3);

        $billFields = [
            'Bill Name' => $bill['name'],
            'Total Amount' => '₦' . number_format($bill['price'], 2),
            'Amount Paid' => '₦' . number_format($bill['amount_paid'], 2),
            'Balance' => '₦' . number_format($bill['price'] - $bill['amount_paid'], 2),
            'Payment Status' => $bill['payment_status'],
            'Reference ID' => $bill['reference_id'] ?? 'N/A',
            'Payment Date' => $bill['last_payment_date'] ? date('F j, Y', strtotime($bill['last_payment_date'])) : 'N/A'
        ];
        foreach ($billFields as $label => $value) {
            $this->Cell(50, 8, $label . ':', 0, 0);
            $this->Cell(100, 8, $value, 0, 1);
        }

        // Footer Note
        $this->Ln(10);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(100, 100, 100);
        $this->MultiCell(0, 8, "This document serves as an official payment receipt. Please keep it for your records. Contact our support team for any issues or inquiries.");
    }
}

// Generate the PDF
$pdf = new PDFReceipt();
$pdf->AddPage();
$pdf->BillDetails($bill, $my_details);
$pdf->Output('I', 'Receipt_' . $bill['id'] . '.pdf');
