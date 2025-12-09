<?php
// Pastikan kode ini berada di bagian atas file atau file yang di-include sebelumnya
require '../vendor/autoload.php'; // Path ke autoload.php
include "../config/database.php"; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

if (isset($_GET['id_bidang'])) {
    // Ambil data survei dari database
    $id_bidang = $_GET['id_bidang'];
    $data_rating = mysqli_query($conn, "SELECT * FROM survei WHERE id_bidang = '$id_bidang'");
    $data_bidang = mysqli_query($conn, "SELECT * FROM bidang WHERE id_bidang = '$id_bidang'");
    
    // Buat objek Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Judul kop surat
    if ($row = mysqli_fetch_assoc($data_bidang)) {
        $nama_bidang = $row['nama_bidang'];
    }
    $sheet->setCellValue('A1', 'DINAS PENDIDIKAN DAN KEBUDAYAAN');
    $sheet->setCellValue('A2', 'KABUPATEN PAMEKASAN');
    $sheet->setCellValue('A3', 'DATA SURVEI '. $nama_bidang);
    $sheet->mergeCells('A1:J1');
    $sheet->mergeCells('A2:J2');
    $sheet->mergeCells('A3:J3');
    $sheet->getStyle('A1:A3')->getFont()->setBold(true);
    $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getRowDimension('1')->setRowHeight(30);
    
    // Tulis header
    $sheet->setCellValue('A5', 'No');
    $sheet->setCellValue('B5', 'Tanggal');
    $sheet->setCellValue('C5', 'Survei Interaksi');
    $sheet->setCellValue('D5', 'Survei Cepat');
    $sheet->setCellValue('E5', 'Survei Tepat');
    $sheet->setCellValue('F5', 'Survei Masalah');
    $sheet->setCellValue('G5', 'Survei Kesalahan');

    // Mengatur style untuk header (tebal)
    $headerStyle = [
        'font' => ['bold' => true],
    ];
    $sheet->getStyle('A5:G5')->applyFromArray($headerStyle);
    
    // Menyisipkan data survei ke dalam spreadsheet
    $row = 6; // Mulai dari baris kedua (setelah header)
    while ($data = mysqli_fetch_assoc($data_rating)) {
        $sheet->setCellValue('A' . $row, $row - 5);
        $sheet->setCellValue('B' . $row, $data['tgl_survei']);
        $sheet->setCellValue('C' . $row, $data['survei_interaksi']);
        $sheet->setCellValue('D' . $row, $data['survei_cepat']);
        $sheet->setCellValue('E' . $row, $data['survei_tepat']);
        $sheet->setCellValue('F' . $row, $data['survei_masalah']);
        $sheet->setCellValue('G' . $row, $data['survei_kesalahan']);
        $row++;
    }

    // Mengatur lebar kolom
    foreach (range('A', 'G') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

     // Mengatur border untuk seluruh data
    $lastRow = $sheet->getHighestRow();
    $sheet->getStyle('A5:G' . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);


    // Mengatur header HTTP untuk mengirim file Excel ke browser
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="survei.xlsx"');
    header('Cache-Control: max-age=0');

    // Menulis file Excel ke output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    exit(); // Berhenti setelah mengirim file Excel
}
?>