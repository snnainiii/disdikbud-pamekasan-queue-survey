<?php 
session_start(); 
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
include '../config/database.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Edit Bidang</title>
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
            <div class="tableUsers">
                <!-- JUDUL -->
                <h1>UBAH PASSWORD </h1>
                <div class="content">
                    <!-- <div class="card-body"> -->
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="nama_bidang" class=" form-control-label">Password
                                        Lama</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="password" name="pass_lama" class="form_login"
                                        placeholder="Password lama ..">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="username" class=" form-control-label">Password
                                        Baru</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="password" name="pass_baru" class="form_login"
                                        placeholder="Password baru ..">

                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="username" class=" form-control-label">Password
                                        Baru, Lagi</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="password" name="konf_pass" class="form_login"
                                        placeholder="Password baru, lagi ..">
                                </div>
                            </div>

                            <div class="row form-group">
                                <button type="submit" value="Ubah" name="edit"
                                    class=" form-control submit">Simpan</button>
                            </div>

                            <div class="row form-group">
                                <a class="link" href="kelola_bidang.php">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- QUERY -->
    <?php include "../config/database.php";
    if (isset($_POST['edit'])) {
        $id= $_GET['id_login'];

        $pass_lama = $_POST['pass_lama'];
        $pass_baru = $_POST['pass_baru'];
        $konf_pass = $_POST['konf_pass'];
        //cek old password
        $query = "SELECT * FROM login WHERE id_login='$id' AND pw='$pass_lama'";
        $sql = mysqli_query ($conn,$query);
        $hasil = mysqli_num_rows ($sql);
    if (! $hasil >= 1) {
        ?>
    <script language="JavaScript">
    alert('Password lama tidak sesuai!, silahkan ulang kembali!');
    document.location = 'ubahpw.php';
    </script>
    <?php
    }
    //validasi data data kosong
    else if (empty($_POST['pass_baru']) || empty($_POST['konf_pass'])) {
            echo "<h3><font color=red>Ganti Password Gagal! Data Tidak Boleh Kosong.</font></h3>";    
    }
    //validasi input konfirm password
    else if (($_POST['pass_baru']) != ($_POST['konf_pass'])) {
            echo "<h3><font color=red><center>Ganti Password Gagal! Password dan Konfirm Password Harus Sama.</center></font></h3>";    
    }
    else {
        //update data
        $query = "UPDATE login SET pw='$pass_baru' WHERE id_login='$id'";
        $sql = mysqli_query ($conn,$query);
        //setelah berhasil update
        if ($sql) { ?>
    <script language="JavaScript">
    alert('Password Berhasil Diubah');
    document.location = 'kelola_bidang.php';
    </script>
    <?php 
        } else {
            echo "<script> alert ('Password Gagal Diubah')</script>";  
        }
    }
    }
?>

    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!-- <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->

</body>

</html>