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
    
        </div>
        <!-- ======================= Tabel ================== -->
        <div class="tableUsers" id="tableUsers">
    <?php
    $sql = "SELECT 
                tanggal, 
                COUNT(no_antrian) AS jumlah_antrian, 
                b.nama_bidang AS bidang, 
                p.nama_pelayanan AS nama_pelayanan
            FROM 
                antrian 
                JOIN bidang b ON antrian.id_bidang = b.id_bidang 
                JOIN pelayanan p ON antrian.id_pelayanan = p.id_pelayanan
            GROUP BY 
                tanggal, 
                b.nama_bidang, 
                p.nama_pelayanan
            ORDER BY 
                tanggal";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table class='content-tableUsers'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>No</th>";
        echo "<th>Tanggal</th>";
        echo "<th>Jumlah Antrian</th>";
        echo "<th>Bidang</th>";
        echo "<th>Nama Pelayanan</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody align='center'>";

        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['tanggal'] . "</td>";
            echo "<td>" . $row['jumlah_antrian'] . "</td>";
            echo "<td>" . $row['bidang'] . "</td>";
            echo "<td>" . $row['nama_pelayanan'] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
    ?>
</div>

        <!-- =========== Scripts =========  -->
        <script src="../assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <!-- <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->

</body>

</html>