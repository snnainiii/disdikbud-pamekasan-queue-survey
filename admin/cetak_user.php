<?php
// Pastikan kode ini berada di bagian atas file atau file yang di-include sebelumnya
require '../vendor/autoload.php';
include "../config/database.php"; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

if (isset($_GET['id_bidang'])) {
    // Ambil data antrian dari database
    $id_bidang = $_GET['id_bidang'];
    $data_antrian = mysqli_query($conn, "SELECT antrian.no_antrian, antrian.tanggal, user.nama, user.jenis_kelamin, user.tempat_lahir, user.tanggal_lahir, user.nik, user.alamat, pelayanan.nama_pelayanan FROM antrian INNER JOIN user ON antrian.id_user = user.id_user INNER JOIN pelayanan ON antrian.id_pelayanan = pelayanan.id_pelayanan WHERE antrian.id_bidang = '$id_bidang'");
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
    $sheet->setCellValue('A3', 'DATA ANTRIAN USER '. $nama_bidang);
    $sheet->mergeCells('A1:J1');
    $sheet->mergeCells('A2:J2');
    $sheet->mergeCells('A3:J3');
    $sheet->getStyle('A1:A3')->getFont()->setBold(true);
    $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getRowDimension('1')->setRowHeight(30);

    // Tulis header
    $sheet->setCellValue('A5', 'No');
    $sheet->setCellValue('B5', 'Nomor Antrian');
    $sheet->setCellValue('C5', 'Tanggal');
    $sheet->setCellValue('D5', 'Nama');
    $sheet->setCellValue('E5', 'Jenis Kelamin');
    $sheet->setCellValue('F5', 'Tempat Lahir');
    $sheet->setCellValue('G5', 'Tanggal Lahir');
    $sheet->setCellValue('H5', 'NIK');
    $sheet->setCellValue('I5', 'Alamat');
    $sheet->setCellValue('J5', 'Keperluan');
    
    // Mengatur style untuk header (tebal)
    $headerStyle = [
        'font' => ['bold' => true],
    ];
    $sheet->getStyle('A5:J5')->applyFromArray($headerStyle);
    
    // Menyisipkan data antrian ke dalam spreadsheet
    $row = 6; // Mulai dari baris keenam (setelah judul, header, dan beri sedikit ruang kosong)
    while ($data = mysqli_fetch_assoc($data_antrian)) {
        $sheet->setCellValue('A' . $row, $row - 5);
        $sheet->setCellValue('B' . $row, $data['no_antrian']);
        $sheet->setCellValue('C' . $row, $data['tanggal']);
        $sheet->setCellValue('D' . $row, $data['nama']);
        $sheet->setCellValue('E' . $row, $data['jenis_kelamin']);
        $sheet->setCellValue('F' . $row, $data['tempat_lahir']);
        $sheet->setCellValue('G' . $row, $data['tanggal_lahir']);
        $sheet->setCellValue('H' . $row, $data['nik']);
        $sheet->setCellValue('I' . $row, $data['alamat']);
        $sheet->setCellValue('J' . $row, $data['nama_pelayanan']);
        $row++;
    }

    // Mengatur lebar kolom
    foreach (range('A', 'J') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Mengatur border untuk seluruh data
    $lastRow = $sheet->getHighestRow();
    $sheet->getStyle('A5:J' . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    // Mengatur header HTTP untuk mengirim file Excel ke browser
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="data_user.xlsx"');
    header('Cache-Control: max-age=0');

    // Menulis file Excel ke output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    exit(); // Berhenti setelah mengirim file Excel
}
?>