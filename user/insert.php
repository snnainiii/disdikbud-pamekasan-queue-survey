<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    require_once "../config/database.php";

    $id_user = $_GET['id_user'];
    $id_bidang = $_GET['id_bidang'];
    $id_pelayanan = $_GET['id_pelayanan'];

    $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7); // Format tanggal

    // Ambil nomor antrian terakhir dari tabel 'antrian' berdasarkan tanggal dan id_pelayanan
    $query = mysqli_query($conn, "SELECT MAX(CAST(SUBSTRING(no_antrian, LENGTH(no_antrian) - 2) AS UNSIGNED)) AS last_number
                                    FROM antrian 
                                    WHERE tanggal='$tanggal' AND id_pelayanan = '$id_pelayanan'")
        or die('Ada kesalahan pada query tampil data : ' . mysqli_error($conn));
    
        // ambil data kode antrian
    $kode  = mysqli_query($conn, "SELECT kode_antrian FROM pelayanan WHERE id_pelayanan = '$id_pelayanan'")
                                    or die ('Ada kesalahan pada query tampil data : ' . mysqli_error($conn));
    // Ambil data hasil query
    $data_kode = mysqli_fetch_assoc($kode);
    $data = mysqli_fetch_assoc($query);

    // Buat variabel untuk menampilkan data
    $last_number = $data['last_number'];
    $kode_antrian = $data_kode['kode_antrian'];

    // Inisialisasi nomor antrian
    if ($last_number != null) {
        // Jika nomor antrian sudah ada, tambahkan 1 ke nomor antrian terakhir
        $next_number = $last_number + 1;
        $nomor_antrian = sprintf("%s%03d", $kode_antrian, $next_number);
    } else {
        // Jika belum ada nomor antrian, inisialisasi dengan kode + '001'
        $nomor_antrian = $kode_antrian . '001';
    }

    // Sekarang Anda dapat menggunakan $nomor_antrian untuk menambahkan antrian baru ke database.
    $insert = mysqli_query($conn, "INSERT INTO antrian (id_user, tanggal, no_antrian, id_bidang, id_pelayanan)
                               VALUES ('$id_user', '$tanggal', '$nomor_antrian', '$id_bidang', '$id_pelayanan')")
        or die('Ada kesalahan pada query insert : ' . mysqli_error($conn));

    if ($insert) {
        // Mengembalikan nomor antrian baru sebagai respons
        echo $nomor_antrian;
    } else {
        echo "Gagal menambahkan antrian";
    }
}
?>