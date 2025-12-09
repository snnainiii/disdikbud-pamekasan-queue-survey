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
        </div>

        <!-- ======================= FORM ================== -->
        <div class="tableUsers">
            <!-- JUDUL -->
            <?php                
                $id_bidang = $_GET['id_bidang'];
                // $id_bidang = $_SESSION['id_bidang'];
                $data = mysqli_query($conn, "SELECT * FROM bidang WHERE id_bidang ='$id_bidang'");
                while ($tampil = mysqli_fetch_array($data) ){ ?>
            <h1>EDIT SURVEI <?php echo $tampil['nama_bidang'];?></h1>
            <?php } ?>
            <div class="content">
                <!-- <strong class="card-title">Tambah Data Bidang</strong> -->
            </div>
            <!-- <div class="card-body"> -->
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                <?php
                                        $id_survei = $_GET['id_survei'];
                                        $data_rating = mysqli_query($conn, "select * from survei WHERE id_survei = '$id_survei' ");
                                        while ($data = mysqli_fetch_assoc($data_rating)) {
                                        ?>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nama">Tanggal</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="tgl_survei" name="tgl_survei"
                                value="<?php echo $data['tgl_survei']?>" placeholder="<?php echo $data['tgl_survei']?>"
                                readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="survei_interaksi" class=" form-control-label">Interaksi
                                dengan petugas layanan,
                                apakah mereka ramah, membantu,
                                dan
                                sopan?</label></div>
                        <div class="col-12 col-md-9">
                            <select id="survei_interaksi" name="survei_interaksi" class="select_survei"
                                value="<?php echo $data['survei_interaksi']?>">
                                <option value="Sangat Puas">Sangat Puas</option>
                                <option value="Puas">Puas</option>
                                <option value="Netral">Netral</option>
                                <option value="Tidak Puas">Tidak Puas</option>
                                <option value="Sangat Tidak Puas">Sangat Tidak Puas</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="survei_cepat" class=" form-control-label">Apakah
                                petugas memberikan pelayanan
                                secara cepat?</label></div>
                        <div class="col-12 col-md-9">
                            <select id="survei_cepat" name="survei_cepat" class="select_survei"
                                value="<?php echo $data['survei_cepat']?>">
                                <option value="Sangat Puas">Sangat Puas</option>
                                <option value="Puas">Puas</option>
                                <option value="Netral">Netral</option>
                                <option value="Tidak Puas">Tidak Puas</option>
                                <option value="Sangat Tidak Puas">Sangat Tidak Puas</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="survei_tepat" class=" form-control-label">Apakah
                                petugas memberikan pelayanan
                                secara tepat sejak
                                awal?</label></div>
                        <div class="col-12 col-md-9">
                            <select id="survei_tepat" name="survei_tepat" class="select_survei"
                                value="<?php echo $data['survei_tepat']?>">
                                <option value="Sangat Puas">Sangat Puas</option>
                                <option value="Puas">Puas</option>
                                <option value="Netral">Netral</option>
                                <option value="Tidak Puas">Tidak Puas</option>
                                <option value="Sangat Tidak Puas">Sangat Tidak Puas</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="survei_masalah" class=" form-control-label">Jika anda
                                memiliki masalah, apakah
                                petugas bersungguh-sungguh
                                berusaha membantu
                                memecahkan masalah tersebut?</label></div>
                        <div class="col-12 col-md-9">
                            <select id="survei_masalah" name="survei_masalah" class="select_survei"
                                value="<?php echo $data['survei_masalah']?>">
                                <option value="Sangat Puas">Sangat Puas</option>
                                <option value="Puas">Puas</option>
                                <option value="Netral">Netral</option>
                                <option value="Tidak Puas">Tidak Puas</option>
                                <option value="Sangat Tidak Puas">Sangat Tidak Puas</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="survei_kesalahan" class=" form-control-label">Apakah
                                petugas selalu berusaha
                                meminimalisir kesalahan pada
                                pelayanan yang
                                diberikan?</label></div>
                        <div class="col-12 col-md-9">
                            <select id="survei_kesalahan" name="survei_kesalahan" class="select_survei"
                                value="<?php echo $data['survei_kesalahan']?>">
                                <option value="Sangat Puas">Sangat Puas</option>
                                <option value="Puas">Puas</option>
                                <option value="Netral">Netral</option>
                                <option value="Tidak Puas">Tidak Puas</option>
                                <option value="Sangat Tidak Puas">Sangat Tidak Puas</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <button type="submit" value="Edit" name="edit" class=" form-control submit">
                            edit</button>
                    </div>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
    </div>

    <!-- QUERY -->
    <?php
                $id_survei = $_GET['id_survei'];
                if (isset($_POST['edit'])) {
                    $tgl_survei = $_POST['tgl_survei'];
                    $survei_interaksi = $_POST['survei_interaksi'];
                    $survei_cepat = $_POST['survei_cepat'];
                    $survei_tepat = $_POST['survei_tepat'];
                    $survei_masalah = $_POST['survei_masalah'];
                    $survei_kesalahan = $_POST['survei_kesalahan'];

                    $edit = mysqli_query($conn, "UPDATE survei SET tgl_survei = '$tgl_survei', survei_interaksi = '$survei_interaksi', survei_cepat = '$survei_cepat', survei_tepat = '$survei_tepat', survei_masalah = '$survei_masalah', survei_kesalahan = '$survei_kesalahan' WHERE id_survei= '$id_survei'");

                    // Periksa apakah query berhasil dieksekusi
                    if ($edit) {
                        $id_bidang = $_GET['id_bidang'];
                        echo "<script>
                                alert('Data berhasil diedit');
                                window.location.href = 'detail_survei.php?id_bidang=" . $id_bidang . "';
                            </script>";
                    } else {
                        echo "<script>
                                alert('Data Gagal diedit');
                                window.location.href = 'detail_survei.php?id_bidang=" . $id_bidang . "';
                            </script>";
                    }
                }
                ?>

    </div>

    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!-- <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->

</body>

</html>