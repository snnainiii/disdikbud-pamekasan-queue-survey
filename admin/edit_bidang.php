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


        <!-- ======================= Tabel ================== -->
        <div class="tableUsers">
            <!-- JUDUL -->
            <h1>EDIT BIDANG </h1>
            <div class="content">
                <!-- <div class="card-body"> -->
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <?php
              $id_profil = $_SESSION['id_profil'];
          $id_bidang= $_GET['id_bidang'];

              $data_rating = mysqli_query($conn, "select * from login RIGHT JOIN bidang ON login.id_bidang = bidang.id_bidang where login.id_bidang= '$id_bidang' and nama_bidang != 'superadmin'; ");
              while ($data = mysqli_fetch_assoc($data_rating)) {
              ?>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="nama_bidang" class=" form-control-label">Nama
                                    Bidang</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="nama" name="nama_bidang"
                                    value="<?php echo $data['nama_bidang']?>">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="username" class=" form-control-label">Username</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="user" name="username" value="<?php echo $data['username']?>">

                            </div>
                        </div>

                        <div class="row form-group">
                            <button type="submit" value="Edit" name="edit" class=" form-control submit">Simpan</button>
                        </div>

                        <div class="row form-group">
                            <p>Ubah Password? <a href="ubahpw.php?id_login=<?php echo $data['id_login']; ?>">Ubah</a>
                            </p>

                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>

    <!-- QUERY -->
    <?php
          $id_bidang= $_GET['id_bidang'];
          if (isset($_POST['edit'])) {
            $username = $_POST['username'];
            $nama = $_POST['nama_bidang'];
            $edit= mysqli_query($conn, "UPDATE login SET username = '$username' WHERE id_bidang= '$id_bidang'");
            $edit2= mysqli_query($conn, "UPDATE bidang SET nama_bidang = '$nama' WHERE id_bidang= '$id_bidang'");
            $name=$_FILES['file_video']['name'];
            $type=$_FILES['file_video']['type'];
            $size=$_FILES['file_video']['size'];
            $nama_file=str_replace(" ","_",$name);
            $tmp_name=$_FILES['file_video']['tmp_name'];
            $nama_folder="video/";
            $file_baru=$nama_folder.basename($nama_file);
            if ((($type == "video/mp4") || ($type == "video/3gpp"))){
               move_uploaded_file($tmp_name,$file_baru);
               mysqli_query ($conn,"UPDATE bidang SET video_pelayanan='$name' WHERE id_bidang='$id_bidang'");
               $pesan="Upload file video $nama_file berhasil diupload";
            }
            else{
                $pesan=".!";
            }       
            echo "<p style='color:green;'>$pesan</p>";

            if ($edit or $edit2) {
              echo "<script> alert ('Data berhasil diedit');
              document.location='kelola_bidang.php';
              </script>";
              
            } else{
              echo "<script> alert ('Data Gagal diedit') ;
              document.location='kelola_bidang.php';
              </script>";
              
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