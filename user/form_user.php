<?php 
include "../config/database.php"; 
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Display</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<style>
body {
    background-image: url(../assets/imgs/bg.jpeg);
}
</style>

<body class="body-user">

    <header>
        <div id="logo-container">
            <img src="../assets/imgs/logo.png" alt="Logo Instansi" id="logo">
            <div>
                <div id="instansi">DINAS PENDIDIKAN DAN KEBUDAYAAN KAB. PAMEKASAN</div>
                <div id="alamat">Jl. Dirgahayu, Tengah, Nyalabu Laok, Kec. Pamekasan, Kabupaten Pamekasan, Jawa Timur
                    69317</div>
            </div>
        </div>
        <div>
            <div id="jam"></div>
            <div id="tanggal"></div>
            <script>
            function updateClock() {
                var now = new Date();
                var hours = now.getHours();
                var minutes = now.getMinutes();
                var seconds = now.getSeconds();

                var dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                var day = now.getDay();
                var date = now.getDate();
                var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                    "September", "Oktober", "November", "Desember"
                ];
                var month = now.getMonth();
                var year = now.getFullYear();

                hours = hours < 10 ? '0' + hours : hours;
                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                document.getElementById('jam').innerText = hours + ':' + minutes + ':' + seconds + (" WIB ");
                document.getElementById('tanggal').innerText = dayNames[day] + ', ' + date + ' ' + monthNames[month] +
                    ' ' + year;
            }

            setInterval(updateClock, 1000);
            </script>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <div class="content">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data"
            class="form-horizontal">
            <div class="card-body-user">
                <h1 style="color: black;">SILAHKAN ISI DATA DIRI ANDA </h1>
                <table class="form-table">
                    <tr>
                        <td>
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <label for="nama" class="form-label-user">Nama Lengkap</label>
                                </div>
                        </td>
                        <td>
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <label for="nik" class="form-label-user">NIK</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <input type="text" id="nama" name="nama" class="form-control-user" required=""
                                        placeholder="Masukkan Nama Lengkap">
                                </div>
                        </td>
                        <td>
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <input type="number" id="nik" name="nik" class="form-control-user" required=""
                                        placeholder="Masukkan NIK">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <label for="tempat_lahir" class="form-label-user">Tempat Lahir</label>
                                </div>
                        </td>
                        <td>
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <label for="tanggal_lahir" class="form-label-user">Tanggal Lahir</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control-user"
                                        required="" placeholder="Masukkan Tempat Lahir">
                                </div>
                        </td>
                        <td>
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control-user"
                                        required="">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <label for="jenis_kelamin" class="form-label-user">Jenis Kelamin</label>
                                </div>
                        </td>
                        <td>
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <label for="alamat" class="form-label-user">Alamat</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="select_jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>

                                    </select>
                                </div>
                        </td>
                        <td>
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <input type="text" id="alamat" name="alamat" class="form-control-user" required=""
                                        placeholder="Masukkan Alamat">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <label for="keperluan" class="form-label-user">Keperluan</label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="form-group-user">
                                <div class="col col-md-6">

                                    <select id="keperluan" name="keperluan" class="select_keperluan">
                                        <option value="">Pilih Keperluan</option>

                                        <?php
                                     $data_pelayanan = mysqli_query($conn, "select * FROM pelayanan ORDER BY nama_pelayanan ASC ");
                                        while ($data = mysqli_fetch_assoc($data_pelayanan)) {
                                        // mengambil 2 id dalam 1 option
                                        $combined_value = $data['id_pelayanan'] . '_' . $data['id_bidang'];
                                        ?>
                                        <option value="<?php echo $combined_value; ?>">
                                            <?php echo  $data['nama_pelayanan']; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="form-group-user">
                                <div class="col col-md-6">
                                    <button type="submit" value="tambah" name="tambah" class="submit">Simpan</button>
                                </div>
                                <br>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>

    <!-- ==================== QUERY ==================== -->
    <?php
    // $id_pelayanan = $_GET['nama_pelayanan'];
    if (isset($_POST['tambah'])) {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $nik = $_POST['nik'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $selected_option = $_POST['keperluan'];
         // Memisahkan id_pelayanan dan id_bidang
        list($id_pelayanan, $id_bidang) = explode('_', $selected_option);

        $tambah = "INSERT INTO user (nama, alamat, nik, tempat_lahir, tanggal_lahir, jenis_kelamin, id_pelayanan)
            VALUES ('$nama', '$alamat', '$nik', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$id_pelayanan')";

        if ($conn->query($tambah) === TRUE) {
        // Mendapatkan id_user yang baru saja dimasukkan
        $id_user_baru = mysqli_insert_id($conn);

        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href =  'antrian.php?id_pelayanan=" . $id_pelayanan . "&id_bidang=" . $id_bidang . "&id_user=" . $id_user_baru . "'; 
              </script>";
        } else {
            echo "<script>
                    alert('Error: " . $conn->error . "');
                    window.location.href = 'form_user.php'; 
                </script>";
            
        }
    }
    ?>

</body>

</html>