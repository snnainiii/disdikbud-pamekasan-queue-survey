<?php
// Mulai sesi jika belum dimulai
session_start();

// Periksa apakah permintaan merupakan permintaan AJAX
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    // Sertakan file koneksi database
    require_once "../config/database.php";
    
    // Periksa apakah data id_antrian dan loket telah diterima dari AJAX
    if (isset($_POST['id_antrian']) && isset($_POST['loket'])) {
        // Tangkap nilai id_antrian dan loket
        $id_antrian = $_POST['id_antrian'];
    $loket = $_POST['loket'];

        // Selanjutnya, Anda dapat melanjutkan dengan proses update database
        $status = "dipanggil";
        $updated_date = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

        // update ke db
        $update = mysqli_query($conn, "UPDATE antrian
                                        SET status='$status', id_loket='$loket', update_date='$updated_date'
                                        WHERE id_antrian='$id_antrian'")
                                        or die('Ada kesalahan pada query update : ' . mysqli_error($conn));

        
       
        // Periksa apakah update berhasil
        if ($update) {
            echo "Data berhasil diupdate";
            $status_loket = "terisi";
            // update loket
            $update_loket = mysqli_query($conn, "UPDATE loket SET status = '$status_loket', update_date = '$updated_date' WHERE id_loket = '$loket'");
        } else {
            echo "Gagal mengupdate data";
        }
    } else {
        echo "ID antrian atau loket tidak diberikan";
    }
}
?>