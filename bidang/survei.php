<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Hasil Survei</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>

<body>
    <?php include "../config/database.php"; ?>
    <?php include 'layout_bidang.php'; ?>
    <!-- =============== Navigation ================ -->
    <div class="container">


        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <form action="" method="get" style="display: flex; align-items: center;">
                    <div class="filter">
                        <select id="tahunSelect" name="tahun">
                            <option value="">Pilih tahun</option>
                            <?php
                            $qry = mysqli_query($conn, "SELECT tgl_survei FROM survei where id_bidang= '$id_bidang' GROUP BY year(tgl_survei)");
                            while ($t = mysqli_fetch_array($qry)) {
                                $data = explode('-', $t['tgl_survei']);
                                $tahun = $data[0];
                                echo "<option value='$tahun'>$tahun</option>";
                            }
                        ?>
                        </select>

                    </div>
                </form>

                <form action="" method="get" style="display: flex; align-items: center;">
                    <div class="search">
                        <label>
                            <input type="text" name="cari" placeholder="Cari Berdasarkan Tanggal (YYYY-MM-DD)">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </div>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                </form>
                <!-- cetak -->
                <div id="cetak">
                    <form action="cetak_survei_bidang.php" method="get">
                        <input type="hidden" name="id_bidang" value="<?php echo $_SESSION['id_bidang']; ?>">
                        <button type="submit">Cetak Survei</button>
                    </form>
                </div>

            </div>

            <div class="table">
                <?php
        if (isset($_SESSION['id_bidang'])) {
            $id_bidang = $_SESSION['id_bidang'];
            $data = mysqli_query($conn, "SELECT * FROM bidang WHERE id_bidang ='$id_bidang'");

            while ($tampil = mysqli_fetch_array($data)) { 
                echo "<h1>HASIL SURVEI " . $tampil['nama_bidang'] . "</h1>";
            }
            
        }  
        ?>


                <table class="content-table">
                    <!-- <thead>
                        <th colspan="7">SURVEI KESELURUHAN</th>
                    </thead> -->
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Survei Interaksi</th>
                        <th>Survei Cepat</th>
                        <th>Survei Tepat</th>
                        <th>Survei Masalah</th>
                        <th>Survei Kesalahan</th>
                    </thead>

                    <tbody>
                        <?php
                    $no = 1;
                    if (isset($_GET['cari'])) {
                        $cari = $_GET['cari'];
                        $id_bidang = $_SESSION['id_bidang'];
                        $data_survei = mysqli_query($conn, "SELECT * FROM survei INNER JOIN bidang ON survei.id_bidang = bidang.id_bidang WHERE survei.id_bidang = '$id_bidang' AND tgl_survei LIKE '%$cari%' ORDER BY survei.id_survei DESC");
                    } elseif (isset($_GET['tahun'])) {
                        $tahun = $_GET['tahun'];
                        $id_bidang = $_SESSION['id_bidang'];
                        $data_survei = mysqli_query($conn, "SELECT * FROM survei INNER JOIN bidang ON survei.id_bidang = bidang.id_bidang WHERE survei.id_bidang = '$id_bidang' AND YEAR(survei.tgl_survei) = '$tahun' ORDER BY survei.id_survei DESC");
                    } else {
                        $id_bidang = $_SESSION['id_bidang'];
                        $data_survei = mysqli_query($conn, "SELECT * FROM survei WHERE id_bidang = '$id_bidang' ORDER BY survei.id_survei DESC");
                    }
                    while ($data = mysqli_fetch_assoc($data_survei)) {
                ?>
                        <tr>
                            <td class="nomor"><?php echo $no++ ?></td>
                            <td><?php echo $data['tgl_survei']; ?></td>
                            <td><?php echo $data['survei_interaksi']; ?></td>
                            <td><?php echo $data['survei_cepat']; ?></td>
                            <td><?php echo $data['survei_tepat']; ?></td>
                            <td><?php echo $data['survei_masalah']; ?></td>
                            <td><?php echo $data['survei_kesalahan']; ?></td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>



                <!-- =========== Scripts =========  -->
                <script src="../assets/js/main.js"></script>

                <!-- ====== ionicons ======= -->
                <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                <!-- <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->

                <!-- pilih berdasarkan tahun  -->
                <script>
                document.getElementById("tahunSelect").addEventListener("change", function() {
                    this.form.submit();
                });
                </script>

</body>

</html>