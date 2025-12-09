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
    <div class="tableUsers">
    <h1 style="text-align: center; background-color: #03401d;">PILIH BIDANG !!!</h1>


            <div class="adm-grid-container">

                <?php
            $no = 1;
            $data_bidang = mysqli_query($conn, "SELECT * FROM bidang WHERE nama_bidang != 'superadmin';");
            while ($tampil = mysqli_fetch_assoc($data_bidang)) {
            ?>
                <a href="survei_users.php?id_bidang=<?php echo $tampil['id_bidang']; ?>" class="adm-grid-item">
                    <span><?php echo $tampil['nama_bidang']; ?></span>
                    <h1 class="icon">
                        <ion-icon name="people"></ion-icon>

                    </h1>

                </a>
                <?php } ?>
            </div>
            <button onclick="goBack()">Kembali</button>
            <script>
            function goBack() {
            window.history.back();
            }
            </script>
        </div>
       
    </div>

    

</body>

</html>