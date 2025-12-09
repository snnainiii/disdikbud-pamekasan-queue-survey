<?php 
			$bulan_tes =array(
				'01'=>"JANUARI",
				'02'=>"FEBRUARI",
				'03'=>"MARET",
				'04'=>"APRIL",
				'05'=>"MEI",
				'06'=>"JUNI",
				'07'=>"JULI",
				'08'=>"AGUSTUS",
				'09'=>"SEPTEMBER",
				'10'=>"OKTOBER",
				'11'=>"NOVEMBER",
				'12'=>"DESEMBER"
			);
		?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <?php include 'layout_bidang.php'; ?>
    <!-- ========================= Main ==================== -->

    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <form action="" method="get" style="display: flex; align-items: center;">
                <div class="search">
                    <label>
                        <input type="text" name="cari" placeholder="Cari Berdasarkan Tanggal (YYYY-MM-DD)">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                &nbsp; &nbsp;
                <div class="filter">
                    <button type="submit">Cari</button>
                </div>
            </form>

            <!-- cetak -->
            <div class="user" id="cetak">
                <form action="cetak_user_bidang.php" method="get">
                    <input type="hidden" name="id_bidang" value="<?php echo $_SESSION['id_bidang']; ?>">
                    <!-- Tambahkan ini -->
                    <button type="submit">Cetak Data User</button>
                </form>
            </div>
        </div>

        <!-- ======================= Tabel ================== -->
        <!-- mendapatkan hasil cari dan id_bidang -->
        <?php 
        if(isset($_GET['cari']) && isset($_GET['id_bidang'])){
            $cari = $_GET['cari'];
            $id_bidang = $_GET['id_bidang'];
        }
        ?>
        <div class="table">
            <?php

        if (isset($_SESSION['id_bidang'])) {
        $id_bidang = $_SESSION['id_bidang'];
        $data = mysqli_query($conn, "SELECT * FROM bidang WHERE id_bidang ='$id_bidang'");

        while ($tampil = mysqli_fetch_array($data)) { 
            echo "<h1>DATA USER " . $tampil['nama_bidang'] . "</h1>";
        }
    }
        ?>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Antrian</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Keperluan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $id_bidang = $_SESSION['id_bidang'];
                    $no = 1;
                    if(isset($_GET['cari'])){
                       $cari = $_GET['cari'];
                        // $id_bidang = $_GET['id_bidang'];
                        $data_user = mysqli_query($conn, "SELECT antrian.no_antrian, antrian.tanggal, user.nama, user.jenis_kelamin, user.tempat_lahir, user.tanggal_lahir, user.nik, user.alamat, pelayanan.nama_pelayanan FROM antrian INNER JOIN user ON antrian.id_user = user.id_user INNER JOIN pelayanan ON antrian.id_pelayanan = pelayanan.id_pelayanan WHERE antrian.id_bidang = '$id_bidang' and tanggal like '%".$cari."%'
                        ORDER BY antrian.id_antrian DESC");             
                    }else{
                        $id_bidang = $_SESSION['id_bidang'];
                    $data_user= mysqli_query($conn, "SELECT antrian.no_antrian, antrian.tanggal, user.nama, user.jenis_kelamin, user.tempat_lahir, user.tanggal_lahir, user.nik, user.alamat, pelayanan.nama_pelayanan FROM antrian INNER JOIN user ON antrian.id_user = user.id_user INNER JOIN pelayanan ON antrian.id_pelayanan = pelayanan.id_pelayanan  WHERE antrian.id_bidang = '$id_bidang' ORDER BY antrian.id_antrian DESC");       
                    }

                    while ($data = mysqli_fetch_assoc($data_user)) {
                    ?>
                    <tr>
                        <td class="nomor"><?php echo $no++ ?></td>
                        <td><?php echo $data['no_antrian']; ?></td>
                        <td><?php echo $data['tanggal']; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['jenis_kelamin']; ?></td>
                        <td><?php echo $data['tempat_lahir']; ?></td>
                        <td><?php echo $data['tanggal_lahir']; ?></td>
                        <td><?php echo $data['nik']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><?php echo $data['nama_pelayanan']; ?></td>
                    </tr>
                    <?php  }?>
                </tbody>
            </table>
        </div>
        <!-- =========== Scripts =========  -->
        <script src="../assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <!-- <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->

</body>

</html>