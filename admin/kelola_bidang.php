<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Kelola Bidang</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
<?php include 'layout_navbar_admin.php'; ?>

      <!-- ========================= Main ==================== -->
      <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            <div class="user">
                <!-- <img src="../assets/imgs/customer01.jpg" alt=""> -->
            </div>
        </div>
            <!-- ======================= Tabel ================== -->
            <div class="tableUsers">
                <a href="tambah_bidang.php">
                    <button type="button" class="btn btn-primary">Tambah Bidang</button>
                </a>
                <table class="content-tableUsers">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Bidang</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php
            $no = 1;
            $data_bidang = mysqli_query($conn, "select * from login RIGHT JOIN bidang ON login.id_bidang = bidang.id_bidang where login.id_profil='$id_profil' and nama_bidang != 'superadmin'; ");
            while ($data = mysqli_fetch_assoc($data_bidang)) {
            ?>
                        <tr>
                            <td class="nomor"><?php echo $no++ ?></td>
                            <td><?php echo  $data['nama_bidang']; ?></td>
                            <td><?php echo $data['username']; ?></td>
                            <td><?php echo $data['pw']; ?></td>
                            <td>
                                <a href="javascript:void(0);" onclick="hapusData(<?php echo $data['id_bidang']; ?>)">
                                    <i><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAfUlEQVR4nO2TOwqAMBAFV8QD2HlGEewsBAsP4ekCVh5CsBhRUoQIJn4Igpkq2SVvYNmIOAAqYOTIBDRA4so4Cy9xUz8RKB3SAplRT4FO95Rv2KtIcEEweE7xI4EYd59zFEgc0U7cIuJH2zCX4ZMjmq0HV8ldgv6mZAEGO3AFubXkJdYsP0MAAAAASUVORK5CYII="></i>
                                </a>
                                </a>&nbsp; &nbsp; &nbsp;
                                <!-- SCRIPT KONFIRMASI HAPUS -->
                                <script>
                                    function hapusData(id_bidang) {
                                        if (confirm('Apakah Anda yakin ingin menghapus data?')) {
                                            window.location.href = 'delete_bidang.php?id_bidang=' + id_bidang;
                                        }
                                    }
                                </script>
                                <a href='edit_bidang.php?id_bidang=<?php echo $data['id_bidang']; ?>'>
                                    <i><img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAA9UlEQVR4nO3VMUrEQBTG8V1LBUtt7D2Ape4B1gvsVcRmA1oIFmLhWUQQ9AYuCDYqeAFrK/3J4AsMYQXXPMXCrxnmJfl/881LJoPBXxemmOEQ69nwxoeKwSueMc6GNzHfwHkYjbPgV536UqlFkrW+cHWC6vom3nCQAf/M5BY3WXCdXrT3TTPhra7nJcqC+8mVt/qH99+WkcXUfBkeBid4wCTGVPgQTziO+SouU+AB3IqHt6vaSnz2/eABKz+MFyx36ru94QG6C8hFrHwHR7hf+G2ZAy9HbK2SRPSkNH70bXgY7FfwR5xGgmEvcGVwhr2SJAX4m3oHlx4dUBV5vYAAAAAASUVORK5CYII="></i>
                                </a>&nbsp; &nbsp; &nbsp;
                                <a href="detail_bidang.php?id_bidang=<?php echo $data['id_bidang']; ?>">
                                    <button type="button" class="btn btn-outline-primary">Detail</button>
                                </a>
                            </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
         <!-- =========== Scripts =========  -->
     <script src="../assets/js/main.js"></script>
     <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!-- <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->
        
</body>
</html>