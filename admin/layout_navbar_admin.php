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
    <div class="navigation">
        <ul>
            <li>
                <a>
                    <?php
                        $id_profil = $_SESSION['id_profil'];
                        $data = mysqli_query($conn, "SELECT * FROM profil WHERE id_profil='$id_profil'");
                        while ($tampil = mysqli_fetch_array($data) ){ ?>
                    <img src="../assets/imgs/logo.png" class="icon"></img>
                    <span class="title"><?php echo $tampil['nama_instansi'];?></span>
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
                <a href="pelayanan.php">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Pelayanan</span>
                </a>
            </li>
            <li>
                <a href="kelola_bidang.php">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Kelola Bidang</span>
                </a>
            </li>
            <li>
                <a href="dataUser.php">
                    <span class="icon">
                        <ion-icon name="person-add"></ion-icon>
                    </span>
                    <span class="title">Data User</span>
                </a>
            </li>
            <li>
                <a href="survei.php">
                    <span class="icon">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
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