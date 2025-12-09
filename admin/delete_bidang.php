<?php
include '../config/database.php';

$id_bidang= $_GET['id_bidang'];

$hapus= mysqli_query($conn, "DELETE FROM login WHERE id_bidang= '$id_bidang'");
$hapus2= mysqli_query($conn, "DELETE FROM bidang WHERE id_bidang= '$id_bidang'");

if ($hapus && $hapus2) {
	echo "<script> alert ('Data berhasil dihapus');
	document.location='kelola_bidang.php';
	</script>";
	
} else{
	echo "<script> alert ('Data Gagal dihapus') ;
	document.location='kelola_bidang.php';
	</script>";
	
}

?>

