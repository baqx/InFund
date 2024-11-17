<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require '../includes/phpspreadsheet/vendor/autoload.php';
include '../config/config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Verify bill_id is provided and admin is logged in
if (!isset($_POST['bill_id']) || !isset($_SESSION['admin_id'])) {
    header("Location: bills.php");
    exit();
}

$bill_id = $_POST['bill_id'];

// Get bill details with student info
$stmt = $conn->prepare("
    SELECT b.*, u.fullname as student_name, u.email as student_email, 
           u.phone as student_phone, u.matric_no as student_matric
    FROM bills b 
    LEFT JOIN users u ON u.matric_no = b.matric_no 
    WHERE b.id = ? AND b.creator_id = ?
");
$stmt->bind_param("ii", $bill_id, $_SESSION['admin_id']);
$stmt->execute();
$bill = $stmt->get_result()->fetch_assoc();

if (!$bill) {
    header("Location: bills.php");
    exit();
}

// Get payment history
$stmt = $conn->prepare("
    SELECT p.*, u.fullname as paid_by, u.matric_no as student_matric
    FROM payments p
    LEFT JOIN users u ON u.id = p.uid
    WHERE p.bill_id = ?
    ORDER BY p.created_at DESC
");
$stmt->bind_param("i", $bill_id);
$stmt->execute();
$payments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Create new Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set document properties
$spreadsheet->getProperties()
    ->setCreator('Payment System')
    ->setLastModifiedBy('Payment System')
    ->setTitle('Payment History - ' . $bill['name'])
    ->setSubject('Payment History Export')
    ->setDescription('Payment history export for ' . $bill['name']);

// Style header cells
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'],
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '4B5563'],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'],
        ],
    ],
];

// Add bill information
$sheet->setCellValue('A1', 'Bill Details');
$sheet->mergeCells('A1:F1');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->setCellValue('A3', 'Bill Name:');
$sheet->setCellValue('B3', $bill['name']);
$sheet->setCellValue('A4', 'Department:');
$sheet->setCellValue('B4', $bill['department']);
$sheet->setCellValue('A5', 'Level:');
$sheet->setCellValue('B5', $bill['level']);
$sheet->setCellValue('A6', 'Amount:');
$sheet->setCellValue('B6', '₦' . number_format($bill['price'], 2));
$sheet->setCellValue('A7', 'Start Date:');
$sheet->setCellValue('B7', date('M j, Y', strtotime($bill['start_date'])));
$sheet->setCellValue('A8', 'End Date:');
$sheet->setCellValue('B8', date('M j, Y', strtotime($bill['end_date'])));

// Add student information
$sheet->setCellValue('D3', 'Student Name:');
$sheet->setCellValue('E3', $bill['student_name']);
$sheet->setCellValue('D4', 'Matric Number:');
$sheet->setCellValue('E4', $bill['student_matric']);
$sheet->setCellValue('D5', 'Email:');
$sheet->setCellValue('E5', $bill['student_email']);
$sheet->setCellValue('D6', 'Phone:');
$sheet->setCellValue('E6', $bill['student_phone']);

// Style info cells
$sheet->getStyle('A3:A8')->getFont()->setBold(true);
$sheet->getStyle('D3:D6')->getFont()->setBold(true);

// Add payment history header
$sheet->setCellValue('A10', 'Payment History');
$sheet->mergeCells('A10:F10');
$sheet->getStyle('A10')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A10')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Set payment history headers
$headers = ['Date', 'Reference ID', 'Paid By', 'Matric Number', 'Amount', 'Status'];
$col = 'A';
$row = 12;
foreach ($headers as $header) {
    $sheet->setCellValue($col . $row, $header);
    $sheet->getStyle($col . $row)->applyFromArray($headerStyle);
    $col++;
}

// Add payment data
$row = 13;
foreach ($payments as $payment) {
    $sheet->setCellValue('A' . $row, date('M j, Y H:i', strtotime($payment['created_at'])));
    $sheet->setCellValue('B' . $row, $payment['reference_id']);
    $sheet->setCellValue('C' . $row, $payment['paid_by']);
    $sheet->setCellValue('D' . $row, $payment['student_matric']);
    $sheet->setCellValue('E' . $row, '₦' . number_format($payment['amount_paid'], 2));
    $sheet->setCellValue('F' . $row, $payment['status']);
    
    // Style amount cells
    $sheet->getStyle('E' . $row)->getNumberFormat()->setFormatCode('#,##0.00');
    $row++;
}

// Auto-size columns
foreach (range('A', 'F') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Create Excel file
$writer = new Xlsx($spreadsheet);

// Set headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="payment_history_' . date('Y-m-d') . '.xlsx"');
header('Cache-Control: max-age=0');

// Save file to PHP output
$writer->save('php://output');

$stmt->close();
$conn->close();