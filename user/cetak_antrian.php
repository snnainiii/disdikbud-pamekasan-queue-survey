<?php 
include "../config/database.php"; 
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cetak Antrian</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/jsbarcode.min.js"></script>
    <style type="text/css">
    body {
        background-color: white;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0 auto;
    }

    .struk-cetak {
        border: none;
        max-width: 80%;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="struk struk-cetak" id="print">
            <?php
            $id_pelayanan = $_GET['id_pelayanan'];
            $id_bidang = $_GET['id_bidang'];
            $nomor_antrian = $_GET['nomor_antrian'];
            $data_pelayanan = mysqli_query($conn, "SELECT *, bidang.nama_bidang FROM pelayanan INNER JOIN bidang ON pelayanan.id_bidang = bidang.id_bidang WHERE id_pelayanan = '$id_pelayanan' AND bidang.id_bidang = '$id_bidang'  ");
            while ($data = mysqli_fetch_assoc($data_pelayanan)) {
            ?>
            <div class="struk-content">
                <div class="gbr-logo">
                    <img src="../assets/imgs/logo.png" alt="LOGO DISDIKBUD PAMEKASAN">
                </div>
                <h3>DISDIKBUD PAMEKASAN</h3>
                <p class="p-nama-bidang"><?php echo  $data['nama_bidang']; ?></p>
                <p class="p-nama-pelayanan"><?php echo  $data['nama_pelayanan']; ?></p>
            </div>
            <p class="garis">------------------------------------------------------------------</p>
            <p class="p-nomor-antrian">NOMOR ANTRIAN ANDA :</p>
            <?php } ?>

            <?php 
            $data = mysqli_query($conn, "SELECT id_antrian,no_antrian FROM antrian WHERE id_bidang = '$id_bidang' ORDER BY id_antrian DESC LIMIT 1");
            while ($tampil = mysqli_fetch_array($data) ){
            ?>
            <p id="p-antrian" class="nomor-antrian"><?php echo $tampil['no_antrian'] ?> </p>
            <?php } ?>

            <div>
                <p id="tanggal-jam-cetak"></p>
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

                    var tanggalJamString = dayNames[day] + ', ' + date + ' ' + monthNames[month] + ' ' + year +
                        ' ' +
                        hours + ':' + minutes + ':' + seconds + (" WIB ");
                    document.getElementById('tanggal-jam-cetak').innerText = tanggalJamString;
                }

                function redirectToDisplayPage() {
                    window.location.href = 'display.php'; // Redirect ke halaman display.php
                }

                setInterval(updateClock, 1000);
                window.onload = function() {
                    updateClock();
                    window.print();
                };

                if (window.matchMedia) {
                    var mediaQueryList = window.matchMedia('print');
                    mediaQueryList.addListener(function(mql) {
                        if (!mql.matches) {
                            redirectToDisplayPage();
                        }
                    });
                } else {
                    window.onafterprint = redirectToDisplayPage;
                }
                </script>
            </div>
        </div>
    </div>
</body>

</html>