<?php
// Mulai sesi jika belum dimulai
session_start();
require_once "../config/database.php";

// Menerima data survei sebagai string JSON
$data = json_decode(file_get_contents("php://input"));

// Menyimpan nilai survei dari data JSON ke variabel
$survei_interaksi = $data->survei_interaksi;
$survei_cepat = $data->survei_cepat;
$survei_tepat = $data->survei_tepat;
$survei_masalah = $data->survei_masalah;
$survei_kesalahan = $data->survei_kesalahan;
$id_bidang = $_SESSION['id_bidang'];

// Memeriksa apakah data survei sudah dikirim
if (isset($survei_interaksi) && isset($survei_cepat) && isset($survei_tepat) && isset($survei_masalah) && isset($survei_kesalahan)) {
    // Lakukan proses penyimpanan data survei ke database atau tindakan lainnya
    $tgl_survei = date("Y-m-d");
    $query = mysqli_query($conn, "INSERT INTO survei (id_bidang, tgl_survei, survei_interaksi, survei_cepat, survei_tepat, survei_masalah, survei_kesalahan) VALUES ('$id_bidang', '$tgl_survei', '$survei_interaksi', '$survei_cepat', '$survei_tepat', '$survei_masalah', '$survei_kesalahan')");

    // Kirim respons berhasil
    echo json_encode(["success" => true, "message" => "Data survei berhasil diterima dan diproses"]);
} else {
    // Kirim respons gagal jika data survei tidak lengkap atau tidak valid
    echo json_encode(["success" => false, "message" => "Data survei tidak lengkap atau tidak valid"]);
}
?>