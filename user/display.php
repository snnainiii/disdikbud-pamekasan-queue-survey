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
.content {
    overflow: hidden;
}

.content video {
    position: absolute;
    top: 0;
    left: 0;
    margin-top: 110px;
    width: 100%;
    height: 85%;
    z-index: -1;
    object-fit: cover;
    filter: blur(80px);
}
</style>

<body class="body-user">
    <!-- HEADER -->
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
        <video autoplay muted loop>
            <source src="../assets/video/vid_disdik.mp4" type="video/mp4">
        </video>
    </div>
    <div class="button-container1">
        <a href="form_user.php"><button class="button button-form">AMBIL NOMOR ANTRIAN</button></a>
    </div>
    <div class="button-container2">
        <a href="pilihbidangrating.php"><button class="button button-form">BERI RATING</button></a>
    </div>

</body>

</html>