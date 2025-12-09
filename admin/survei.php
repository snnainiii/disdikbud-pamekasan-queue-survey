<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Dashboard Admin</title>
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

        </div>
        <!-- ======================= Tabel ================== -->
        <div class="tableUsers">
            <h1 style="margin-left: 15px;">DATA SURVEI</h1>
            <div class="adm-grid-container">
                <?php
            $no = 1;
            $data_survei = mysqli_query($conn, "SELECT b.id_bidang, b.nama_bidang FROM bidang b LEFT JOIN survei s ON b.id_bidang = s.id_bidang WHERE b.nama_bidang != 'superadmin' GROUP BY b.id_bidang, b.nama_bidang;");       
            while ($data = mysqli_fetch_assoc($data_survei)) {
            ?>
                <a href="detail_survei.php?id_bidang=<?php echo $data['id_bidang']; ?>" class="adm-grid-item">
                    <span><?php echo $data['nama_bidang']; ?></span><br>
                    <h1 class="icon">
                        <ion-icon name="reader-outline"></ion-icon>

                    </h1>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!-- <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->
</body>

</html>