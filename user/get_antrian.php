<?php
session_start();

// pengecekan ajax request untuk mencegah direct access file, agar file tidak bisa diakses secara langsung dari browser
// jika ada ajax request

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    // panggil file "database.php" untuk koneksi ke database
    require_once "../config/database.php";
    
    // Ambil id_bidang dari parameter URL
    $id_bidang = $_GET['id_bidang'];
    $id_pelayanan = $_GET['id_pelayanan'];

    // ambil tanggal sekarang
    $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);

    // sql statement untuk menampilkan jumlah data dari tabel "tbl_antrian" berdasarkan "tanggal"
    $query = mysqli_query($conn, "SELECT count(id_antrian) as jumlah FROM antrian 
                                    WHERE tanggal='$tanggal' and id_pelayanan = '$id_pelayanan'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($conn));
                
    
    // ambil data kode antrian
    $kode  = mysqli_query($conn, "SELECT kode_antrian FROM pelayanan WHERE id_pelayanan = '$id_pelayanan'")
                                    or die ('Ada kesalahan pada query tampil data : ' . mysqli_error($conn));

    //  ambil data hasil query
    $data = mysqli_fetch_assoc($query);
    $data_kode = mysqli_fetch_assoc($kode);

    // buat variabel untuk menampilkan data
    // buat variabel untuk menampilkan data
    $jumlah_antrian = $data['jumlah'] ; 
    $kode_antrian = $data_kode['kode_antrian'];

    // tampilkan data
    echo $kode_antrian . sprintf("%03d", $jumlah_antrian);
    // echo $kode_antrian . sprintf("%03d", $jumlah_antrian);

}