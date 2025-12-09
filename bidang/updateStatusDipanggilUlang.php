<?php
// Mulai sesi jika belum dimulai
session_start();

// Periksa apakah permintaan merupakan permintaan AJAX
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    // Sertakan file koneksi database
    require_once "../config/database.php";
    
    // Periksa apakah data id_antrian telah dikirim melalui POST
    if (isset($_POST['id_antrian'])) {
        // Tangkap nilai id_antrian dan loket
        $id_antrian = $_POST['id_antrian'];
        $updated_date = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

        $status = "dipanggil ulang";

        // update ke db
        $sql = mysqli_query($conn, "UPDATE antrian SET status = '$status', update_date='$updated_date' WHERE id_antrian = $id_antrian")
            or die('Ada kesalahan pada query update : ' . mysqli_error($conn));

        if($sql) {
            echo 'Data berhasil diupdate';
        } else {
            // Tangani jika gagal memperbarui status antrian
            echo 'Gagal memperbarui status antrian';
        }
    } else {
        // Tangani jika tidak ada data yang diterima melalui POST
        echo "Data tidak lengkap";
    }
} else {
    // Tangani jika bukan permintaan AJAX
    echo "Permintaan tidak valid";
}
?>