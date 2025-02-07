<?php

require 'vendor/autoload.php';
include 'koneksi.php';

$query = "SELECT * FROM pelanggan";
$result = mysqli_query($koneksi, $query);

// Membuat objek Spreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$columns = ['id_pelanggan', 'nama', 'username', 'password','no_telpon'];  // Kolom yang akan ditulis
$sheet->setCellValue('A1', $columns[0]);
$sheet->setCellValue('B1', $columns[1]);
$sheet->setCellValue('C1', $columns[2]);
$sheet->setCellValue('D1', $columns[3]);
$sheet->setCellValue('E1', $columns[4]);


// Menulis data pelanggan
$no = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $no, $no - 1);  
    $sheet->setCellValue('B' . $no, $row['nama']); 
    $sheet->setCellValue('C' . $no, $row['username']); 
    $sheet->setCellValue('D' . $no, $row['password']); 
    $sheet->setCellValue('E' . $no, $row['no_telpon']);
    $no++;
}

// Menyimpan file Excel
$writer = new Xlsx($spreadsheet);

// Menyeting header agar file bisa diunduh
$fileName = 'data_pelanggan.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');// Menyatakan tipe file
header('Content-Disposition: attachment;filename="' . $fileName . '"');// Menyimpan file dengan nama yang diinginkan
header('Cache-Control: max-age=0');// Menghapus cache

// Menghasilkan dan mengirim file ke browser
$writer->save('php://output');
exit;
?>