<?php 
session_start(); 
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>
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
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a>
                        <?php
                        // $id_profil = $_SESSION['id_profil'];
                        $id_bidang = $_SESSION['id_bidang'];
                        $data = mysqli_query($conn, "SELECT * FROM bidang WHERE id_bidang='$id_bidang'");
                        while ($tampil = mysqli_fetch_array($data) ){ ?>
                        <img src="../assets/imgs/logo.png" class="icon"></img>
                        <span class="title"><?php echo $tampil['nama_bidang'];?></span>
                        <?php } ?>

                    </a>
                </li>
                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="display.php">
                        <span class="icon">
                            <ion-icon name="tv"></ion-icon>
                        </span>
                        <span class="title">Display Antrian</span>
                    </a>
                </li>
                <li>
                    <a href="panggilAntrian.php">
                        <span class="icon">
                            <ion-icon name="mic"></ion-icon>
                        </span>
                        <span class="title">Panggil Antrian</span>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <span class="icon">
                            <ion-icon name="person-add"></ion-icon>
                        </span>
                        <span class=" title">Data Users
                        </span>
                    </a>
                </li>
                <li>
                    <a href="survei.php">
                        <span class="icon">
                            <ion-icon name="book"></ion-icon>
                        </span>
                        <span class="title">Data Survei</span>
                    </a>
                </li>

                <li>
                    <a href="../logout.php">
                        <?php 
                        include "../config/database.php";
                        $id_profil = $_SESSION['id_profil'];
                        $data = mysqli_query($conn, "SELECT * FROM profil WHERE id_profil='$id_profil'");
                        while ($tampil = mysqli_fetch_array($data) ){
                        ?>
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Logout</span>
                        <?php } ?>
                    </a>
                </li>
            </ul>
        </div>
</body>

</html>