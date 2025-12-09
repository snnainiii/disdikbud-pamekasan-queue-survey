<?php 
include "../config/database.php"; 
    
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" , initial-scale=1.0">
    <title>Display</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
    <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body class="body-user">
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=JIMSuoMG"></script>
    <!-- ========================= Main ==================== -->
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
        <h1 style="text-align: center; margin-top:15px; margin-bottom:15px;">SILAHKAN AMBIL NOMOR ANTRIAN SELANJUTNYA
        </h1>
        <div class="struk" id="print">
            <form action="" method="get" enctype="multipart/form-data" class="form-horizontal">
                <?php
                $id_pelayanan = isset($_GET['id_pelayanan']) ? $_GET['id_pelayanan'] : null;
                $id_bidang = isset($_GET['id_bidang']) ? $_GET['id_bidang'] : null;
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
                <p class="nomor-antrian" id="p-antrian"> </p>

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
                            ' ' + ("/") +
                            hours + ':' + minutes + ':' + seconds + (" WIB ");
                        document.getElementById('tanggal-jam-cetak').innerText = tanggalJamString;
                    }

                    setInterval(updateClock, 1000);
                    </script>
                </div>

                <a insert" href="javascript:void(0)" class="tombol-cetak">
                    <button type="submit" class="cetak" id="insert" onclick="play()">
                        CETAK NOMOR ANTRIAN
                    </button>
                </a>
            </form>
        </div>
    </div>

    <!-- =============== SCRIPT ANTRIAN ============= -->
    <script type="text/javascript">
    $(document).ready(function() {
        var urlParams = new URLSearchParams(window.location.search);
        var id_bidang = urlParams.get('id_bidang');
        var id_pelayanan = urlParams.get('id_pelayanan');
        var id_user = urlParams.get('id_user');

        // Fungsi untuk update jumlah antrian
        function updateAntrian(callback) {
            // Mengatur interval polling setiap 1 detik
            var pollingInterval = setInterval(function() {
                $.ajax({
                    type: 'GET',
                    url: 'get_antrian.php',
                    data: {
                        id_bidang: id_bidang,
                        id_pelayanan: id_pelayanan
                    },
                    success: function(result) {
                        $('#p-antrian').text(result);
                        if (typeof callback === 'function') {
                            callback(); // panggil callback setelah nomor antrian di-update
                        }
                    },
                    error: function(err) {
                        console.error('Error fetching antrian:', err);
                    }
                });
            }, 1000); // Set interval ke 1 detik (1000 milidetik)

            // Menghentikan polling jika diperlukan
            // Misalnya, Anda dapat memanggil clearInterval(pollingInterval); untuk menghentikan polling
        }

        // Panggil fungsi updateAntrian saat halaman pertama kali dimuat
        updateAntrian();

        //  proses insert data
        $('#insert').on('click', function(event) {
            event.preventDefault();

            $.ajax({
                type: 'GET',
                url: 'insert.php',
                data: {
                    id_user: id_user,
                    id_bidang: id_bidang,
                    id_pelayanan: id_pelayanan
                },
                success: function(result) {
                    // Jika proses insert sukses
                    var nomor_antrian = parseInt(result);
                    if (!isNaN(nomor_antrian)) {
                        // tampilkan jumlah antrian
                        $('#p-antrian').text(nomor_antrian);
                        // Memperbarui nomor antrian terlebih dahulu, kemudian mengarahkan ke halaman cetak_antrian.php setelah selesai

                    }
                    updateAntrian(function() {
                        var redirectUrl = 'cetak_antrian.php?id_pelayanan=' +
                            id_pelayanan +
                            '&id_bidang=' + id_bidang + '&nomor_antrian=' +
                            nomor_antrian;
                        window.location = redirectUrl;
                    });
                    play()
                },
                error: function(err) {
                    console.error('Error inserting data:', err);
                }
            });
        });
    });



    function play() {
        responsiveVoice.speak(
            "Nomor Antrian Berhasil Dicetak",
            "Indonesian Female", {
                pitch: 1,
                rate: 1,
                volume: 1
            }
        );
    }
    </script>




</body>

</html>