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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <link rel="stylesheet" href="../assets/css/main.css">

    <style>
    body {
        margin: 0;
        padding: 0;
        background-image: url(../assets/imgs/bg.jpeg);
        background-repeat: no-repeat;
        background-size: cover;
    }

    .container {
        display: flex;
        justify-content: space-between;
        align-items: stretch;
        height: 500px;
    }
    </style>
</head>

<body>
    <header>
        <div id="logo-container">
            <img src="../assets/imgs/logo.png" alt="Logo Instansi" id="logo">
            <div>
                <div id="instansi">DINAS PENDIDIKAN DAN KEBUDAYAAN KAB. PAMEKASAN</div>
                <div id="alamat">Jl. Dirgahayu, Tengah, Nyalabu Laok, Kec. Pamekasan, Kabupaten Pamekasan, Jawa
                    Timur
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
                document.getElementById('tanggal').innerText = dayNames[day] + ', ' + date + ' ' + monthNames[
                        month] +
                    ' ' + year;
            }

            setInterval(updateClock, 1000);
            </script>
        </div>
    </header>
    <div class="judul-display">
        <?php
        include "../config/database.php";
        $id_bidang = $_SESSION['id_bidang'];
        $data = mysqli_query($conn, "SELECT * FROM bidang WHERE id_bidang='$id_bidang'");
        while ($tampil = mysqli_fetch_array($data) ){ ?>
        <h1> ANTRIAN <?php echo $tampil['nama_bidang'];?></h1>
        <?php } ?>
    </div>
    <div class="container">
        <?php 
            $id_bidang = $_SESSION['id_bidang'];
            $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7); // Format tanggal
            
            $card_antrian = mysqli_query($conn, "SELECT antrian.id_antrian, antrian.no_antrian, loket.nama_loket, antrian.id_loket, antrian.status FROM antrian INNER JOIN loket ON antrian.id_loket = loket.id_loket WHERE tanggal='$tanggal' AND antrian.id_bidang = '$id_bidang' AND antrian.status = 'dipanggil' OR antrian.status = 'dipanggil ulang'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($conn));
            
            ?>
        <div class="display-kotak-antrian">
            <div class="dis-antrian-loket">
                <?php
                $no = 1;
                while ($row = mysqli_fetch_array($card_antrian)) {
                ?>
                <div class="kotakKecil">
                    <div class="dis-loket">
                        <p class="dis-nama-loket">Loket</p>
                        <p class="dis-no-loket"><?php echo $row['nama_loket']; ?></p>
                    </div>
                    <div class="dis-antrian">
                        <p class="dis-no-antrian">Nomor Antrian</p>
                        <p class="dis-nama-antrian"><?php echo $row['no_antrian']; ?></p>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="display-kotak-video">
            <div class="kotakBesarVideo">
                <video id="displayVideo" autoplay muted loop class="kotakBesarVideo">
                    <source src="../assets/video/vid_disdik.mp4" type="video/mp4">
                </video>
            </div>
        </div>
</body>
<script>
// Fungsi untuk memuat ulang halaman setiap 5 detik
function reloadPage() {
    // Simpan posisi video sebelum memuat ulang halaman
    var video = document.getElementById('displayVideo');
    var videoPosition = video.currentTime;

    // Memuat ulang halaman
    location.reload();

    // Setelah halaman dimuat kembali, atur kembali posisi video ke posisi yang disimpan
    video = document.getElementById('displayVideo'); // Dapatkan elemen video kembali setelah reload
    video.currentTime = videoPosition; // Setel kembali posisi video
}

// Memanggil fungsi reloadPage setiap 5 detik
setInterval(reloadPage, 100000); // Ubah angka 5000 menjadi jumlah milidetik yang Anda inginkan
</script>


</html>