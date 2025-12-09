<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Tambah Bidang</title>
    <link rel="stylesheet" href="../assets/css/main.css">


</head>

<body>
    <?php include "../config/database.php"; ?>
    <?php include 'layout_navbar_admin.php'; ?>
    <!-- =============== Navigation ================ -->
    <div class="container">
       
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


            <!-- ======================= FORM ================== -->
            <div class="tableUsers">
                <!-- JUDUL -->
                <h1>FORM TAMBAH BIDANG </h1>

                <div class="content">
                    <!-- <div class="card-body"> -->
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="nama_bidang" class=" form-control-label">Nama
                                        Bidang</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="nama_bidang" name="nama_bidang" class="form-control"
                                        required="" placeholder="Ketik Nama Bidang">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="username"
                                        class=" form-control-label">Username</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="username" name="username" class="form-control" required=""
                                        placeholder="Ketik Nama Username">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="pw" class=" form-control-label">Password</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="pw" name="pw">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="repw" class=" form-control-label">Ulangi
                                        Password</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="password" id="repw" name="repw" class="form-control" required="">
                                </div>
                            </div>

                            <div class="row form-group">
                                <button type="submit" value="tambah" name="tambah"
                                    class=" form-control submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ================== QUERY ================ -->
    <?php
          if (isset($_POST['tambah'])) {
           $username = $_POST['username'];
           $nama = $_POST['nama_bidang'];
           $password = $_POST['pw'];
           $cpassword = $_POST['repw'];

           $id_profil = $_SESSION['id_profil'];
           $nama_bidang = mysqli_query($conn,"SELECT nama_bidang FROM bidang WHERE id_profil='$id_profil'");
           if ($nama != $nama_bidang){
                mysqli_query($conn,"INSERT INTO bidang (id_profil,nama_bidang)
                             VALUES ('$id_profil','$nama')");
                $name=$_FILES['file_video']['name'];
                $type=$_FILES['file_video']['type'];
                $size=$_FILES['file_video']['size'];
                $nama_file=str_replace(" ","_",$name);
                $tmp_name=$_FILES['file_video']['tmp_name'];
                $nama_folder="video/";
                $file_baru=$nama_folder.basename($nama_file);
                if ((($type == "video/mp4") || ($type == "video/3gpp"))){
                   move_uploaded_file($tmp_name,$file_baru);
                   mysqli_query($conn,"INSERT INTO pelayanan (video_pelayanan)
                             VALUES ('$name')");
                }
                else{
                    echo "Error: " . mysqli_error($conn);
                }       
                // echo "<p style='color:green;'>$pesan</p>";

                if ($password == $cpassword) {
                 $sql1 = "SELECT * FROM login WHERE username='$username'";
                 $result1 = mysqli_query($conn, $sql1);
                 if (!$result1->num_rows > 0) {
                      $idpel = mysqli_query($conn,"SELECT * FROM bidang order by id_bidang desc limit 1");
                      while ($data = mysqli_fetch_assoc($idpel)) {
                       $data1=  $data['id_bidang'];
                      } 
                     $sql = "INSERT INTO login (username, pw, id_profil, id_bidang) VALUES ('$username','$password', '$id_profil', '$data1')";
                     $result = mysqli_query($conn, $sql);
                     if ($result) { ?>
    <script>
    alert('Selamat, Tambah Bidang berhasil!')
    </script>
    <script>
    document.location = 'kelola_bidang.php';
    </script>
    <?php
                     } else {
                         echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
                     }
                 } else {
                     echo "<script>alert('Woops! Username Sudah Terdaftar.')</script>";
                 }
                  
             } else {
                 echo "<script>alert('Password Tidak Sesuai')</script>";
             }
           }else{
            echo "<script>alert('Nama Bidang Sudah Tersedia')</script>";
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