<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
            <div class="user">
                <!-- <img src="../assets/imgs/customer01.jpg" alt=""> -->
            </div>
        </div>

        <!-- ======================= Tabel ================== -->
        <?php
            $id_bidang = $_GET['id_bidang'];
            // Query untuk mendapatkan informasi bidang
            $query_bidang = "SELECT * FROM bidang WHERE id_bidang = '$id_bidang'";
            $result_bidang = mysqli_query($conn, $query_bidang);
            $bidang = mysqli_fetch_assoc($result_bidang);
        ?>
        

        <div class="tableUsers">
        <h2>Daftar Pelayanan untuk Bidang <?php echo $bidang['nama_bidang']; ?></h2>
        <?php 
        $query_pelayanan = "SELECT * FROM pelayanan WHERE id_bidang = '$id_bidang'";
        $result_pelayanan = mysqli_query($conn, $query_pelayanan);
        if(mysqli_num_rows($result_pelayanan) > 0): ?>
        
        <table class="content-tableUsers">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pelayanan</th>
          </tr>
        </thead>
        <tbody align="center">
            <?php
                $counter = 1;
                while($row_pelayanan = mysqli_fetch_assoc($result_pelayanan)):
            ?>
            <tr>
                <td><?php echo $counter++; ?></td>
                <td><?php echo $row_pelayanan['nama_pelayanan']; ?></td>
                </tr>
            <?php endwhile; ?>
                            
        </tbody>
      </table>
      <?php else: ?>
        <p>Tidak ada data pelayanan untuk bidang <?php echo $bidang['nama_bidang']; ?></p>
        <?php endif; ?>

        </div>
        

    </div>
    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>

     <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!-- <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->
    
</body>
</html>