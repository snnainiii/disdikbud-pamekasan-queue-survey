<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Survei</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <?php include "../config/database.php"; ?>
    <?php include 'layout_navbar_admin.php'; ?>
    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <form action="" method="get" style="display: flex; align-items: center;">
                <input type="hidden" name="id_bidang" value="<?php echo $_GET['id_bidang']; ?>">
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
            <!-- GRAFIK -->
            <?php
            $id_bidang = $_GET['id_bidang'];
            ?>
            <div class="user">
                <button class="btn-grafik" type=""><a
                        href="grafik.php?id_bidang=<?php echo $id_bidang; ?>">Grafik</a></button>
            </div>

            <!-- CETAK DALAM BENTUK EXCEL -->
            <div class="user" id="cetak">
                <form action="cetak_survei.php" method="get">
                    <input type="hidden" name="id_bidang" value="<?php echo $_GET['id_bidang']; ?>">
                    <button type="submit">Cetak Survei</button>
                </form>
            </div>
        </div>
        <!-- ======================= Tabel ================== -->
        <div class="tableUsers" id="tableUsers">
            <?php
                if (isset($_GET['id_bidang'])) {
                $id_bidang = $_GET['id_bidang'];
                $data = mysqli_query($conn, "SELECT * FROM bidang WHERE id_bidang ='$id_bidang'");

                $data_user_ditampilkan = false; // Inisialisasi variabel penanda
                $hasil_cari = isset($_GET['cari']) ? $_GET['cari'] : ""; // Ambil nilai parameter cari dari URL

                while ($tampil = mysqli_fetch_array($data)) { 
                    if ($hasil_cari != "") {
                        // Cek apakah ada hasil pencarian
                        $data_survei = mysqli_query($conn, "SELECT COUNT(*) AS total FROM survei WHERE id_bidang = '$id_bidang' AND tgl_survei = '$hasil_cari'");
                         
                        $jumlah_survei = mysqli_fetch_assoc($data_survei)['total'];

                        if ($jumlah_survei > 0) {
                            echo "<h1>HASIL SURVEI UNTUK TANGGAL " . $hasil_cari . "</h1>";
                        } else {
                            echo "<h1>TIDAK ADA HASIL CARI UNTUK " . $hasil_cari . "</h1>";
                        }

                        $data_user_ditampilkan = true; // Mengatur variabel penanda data user sudah ditampilkan
                    } else {
                        echo "<h1>HASIL SURVEI UNTUK BIDANG " . $tampil['nama_bidang'] . "</h1>";
                    }
                }
            }
                ?>
            <table class="content-tableUsers">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Survei Interaksi</th>
                        <th>Survei Cepat</th>
                        <th>Survei Tepat</th>
                        <th>Survei Masalah</th>
                        <th>Survei Kesalahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody align="center">
                    <?php
                    $no = 1;
                if (isset($_GET['cari']) && isset($_GET['id_bidang'])) {
                    $cari = $_GET['cari'];
                    $id_bidang = $_GET['id_bidang'];
                    $cari = mysqli_real_escape_string($conn, $cari);
                    $id_bidang = mysqli_real_escape_string($conn, $id_bidang);
                    $data_rating = mysqli_query($conn, "SELECT * FROM survei WHERE survei.id_bidang = '$id_bidang' AND tgl_survei LIKE '%$cari%' ORDER BY survei.id_survei DESC");
                    
        
                }else{
                    $id_bidang = $_GET['id_bidang'];
                    $data_rating = mysqli_query($conn, "SELECT * FROM survei WHERE survei.id_bidang = '$id_bidang' ORDER BY survei.id_survei DESC");       
                }
                while ($data = mysqli_fetch_assoc($data_rating)) {
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['tgl_survei']; ?></td>
                        <td><?php echo $data['survei_interaksi']; ?></td>
                        <td><?php echo $data['survei_cepat']; ?></td>
                        <td><?php echo $data['survei_tepat']; ?></td>
                        <td><?php echo $data['survei_masalah']; ?></td>
                        <td><?php echo $data['survei_kesalahan']; ?></td>
                        <td>
                            <a
                                href='edit_survei.php?id_bidang=<?php echo $data['id_bidang']; ?>&id_survei=<?php echo $data['id_survei']; ?>'>

                                <i><img
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAA9UlEQVR4nO3VMUrEQBTG8V1LBUtt7D2Ape4B1gvsVcRmA1oIFmLhWUQQ9AYuCDYqeAFrK/3J4AsMYQXXPMXCrxnmJfl/881LJoPBXxemmOEQ69nwxoeKwSueMc6GNzHfwHkYjbPgV536UqlFkrW+cHWC6vom3nCQAf/M5BY3WXCdXrT3TTPhra7nJcqC+8mVt/qH99+WkcXUfBkeBid4wCTGVPgQTziO+SouU+AB3IqHt6vaSnz2/eABKz+MFyx36ru94QG6C8hFrHwHR7hf+G2ZAy9HbK2SRPSkNH70bXgY7FfwR5xGgmEvcGVwhr2SJAX4m3oHlx4dUBV5vYAAAAAASUVORK5CYII="></i>
                            </a>
                        </td>
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