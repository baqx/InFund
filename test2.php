<?php
require './includes/phpspreadsheet/vendor/autoload.php'; // Autoload PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Add some data
$sheet->setCellValue('A1', 'User ID');
$sheet->setCellValue('B1', 'Full Name');
$sheet->setCellValue('C1', 'Email');
$sheet->setCellValue('D1', 'Balance');

// Example data
$data = [
    ['id' => 1, 'fullname' => 'John Doe', 'email' => 'john@example.com', 'balance' => 500.0],
    ['id' => 2, 'fullname' => 'Jane Smith', 'email' => 'jane@example.com', 'balance' => 300.0],
    // Add more rows as needed
];

// Populate data rows
$row = 2;
foreach ($data as $user) {
    $sheet->setCellValue("A{$row}", $user['id']);
    $sheet->setCellValue("B{$row}", $user['fullname']);
    $sheet->setCellValue("C{$row}", $user['email']);
    $sheet->setCellValue("D{$row}", $user['balance']);
    $row++;
}

// Set auto column width for each column
foreach (range('A', 'D') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Styling the header
$headerStyle = [
    'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['argb' => '4CAF50'], // Success color
    ],
];
$sheet->getStyle('A1:D1')->applyFromArray($headerStyle);

// Output to browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="User_Data.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
