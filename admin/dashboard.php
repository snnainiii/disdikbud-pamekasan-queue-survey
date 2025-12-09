<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <!-- Include Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<style>
    /* CSS styles here */
    body {
        font-family: Arial, sans-serif;
    }


    .form-filter {
        margin-bottom: 20px;
    }

    .form-filter label,
    .form-filter select,
    .form-filter button {
        font-size: 16px;
        padding: 10px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 300px; /* Adjust the width as needed */
        box-sizing: border-box; /* Include padding and border in the width */
    }

    .form-filter button {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .form-filter button:hover {
        background-color: #0056b3;
    }

    #downloadBtn {
        background-color: #28a745;
    }

    #downloadBtn:hover {
        background-color: #218838;
    }
    
</style>

<body>
    <?php include 'layout_navbar_admin.php'; ?>

    <!-- Main content -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>
        
        <div class="table">
            <h1>GRAFIK SURVEI</h1>
            <form action="" method="get" class="form-filter">
            <table>
                <tr>
                    <td><label for="bulan">Bulan:</label></td>
                    <td>
                        <select id="bulan" name="bulan" required>
                            <option value="">Pilih Bulan</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                $bulan = str_pad($i, 2, "0", STR_PAD_LEFT); // format bulan 2 digit
                                echo "<option value='$bulan'>$bulan</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td><label for="tahun">Tahun:</label></td>
                    <td>
                        <select id="tahun" name="tahun" required>
                            <option value="">Pilih Tahun</option>
                            <?php
                            $qry = mysqli_query($conn, "SELECT DISTINCT YEAR(tgl_survei) AS tahun FROM survei");
                            while ($t = mysqli_fetch_array($qry)) {
                                $tahun = $t['tahun'];
                                echo "<option value='$tahun'>$tahun</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="bidang">Bidang:</label></td>
                    <td>
                        <select id="bidang" name="bidang" required>
                            <option value="">Pilih Bidang</option>
                            <?php
                            $qry_bidang = mysqli_query($conn, "SELECT * FROM bidang");
                            while ($bidang = mysqli_fetch_array($qry_bidang)) {
                                echo "<option value='".$bidang['id_bidang']."'>".$bidang['nama_bidang']."</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td><label for="jenis_survei">Jenis Survei:</label></td>
                    <td>
                        <select id="jenis_survei" name="jenis_survei" required>
                            <option value="">Pilih Jenis Survei</option>
                            <option value="survei_interaksi">Survei Interaksi</option>
                            <option value="survei_cepat">Survei Cepat</option>
                            <option value="survei_tepat">Survei Tepat</option>
                            <option value="survei_masalah">Survei Masalah</option>
                            <option value="survei_kesalahan">Survei Kesalahan</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-left: 10px;">
                    <button type="submit" style="margin-left: 90px;">Filter</button>
                    <!-- Tombol unduh -->
                    </td>
                    <td colspan="2" ><button id="downloadBtn" style="margin-left: 137px;">Download Grafik</button></td>

                </tr>
            </table>
            </form>
    



            <?php
            // Check if any filter parameters are set
            if (isset($_GET['bulan']) || isset($_GET['tahun']) || isset($_GET['bidang']) || isset($_GET['jenis_survei'])) {
                // Grafik
                echo '<!-- Grafik -->
                <div class="chart-container">
                    <canvas id="myChart"></canvas>
                </div>';

                // Proses filter data berdasarkan bulan, tahun, bidang, dan jenis survei yang dipilih
                $filterBulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
                $filterTahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
                $filterBidang = isset($_GET['bidang']) ? $_GET['bidang'] : '';
                $filterJenisSurvei = isset($_GET['jenis_survei']) ? $_GET['jenis_survei'] : '';
                
                // Query untuk mengambil jumlah responden untuk setiap kategori survei berdasarkan filter bulan, tahun, bidang, dan jenis survei
                $query = "SELECT 
                                SUM($filterJenisSurvei='Sangat Tidak Puas') as stp,
                                SUM($filterJenisSurvei='Tidak Puas') as tp,
                                SUM($filterJenisSurvei='Netral') as n,
                                SUM($filterJenisSurvei='Puas') as p,
                                SUM($filterJenisSurvei='Sangat Puas') as sp
                            FROM survei 
                            WHERE 1 ";
                if (!empty($filterBulan) && !empty($filterTahun)) {
                    $query .= "AND MONTH(tgl_survei) = '$filterBulan' AND YEAR(tgl_survei) = '$filterTahun'";
                }
                if (!empty($filterBidang)) {
                    $query .= " AND id_bidang = '$filterBidang'";
                }
                $result = mysqli_query($conn, $query);
                $data = mysqli_fetch_assoc($result);

                // Mendefinisikan label dan data survei yang akan ditampilkan dalam grafik sesuai dengan filter
                $labels = ['Sangat Tidak Puas', 'Tidak Puas', 'Netral', 'Puas', 'Sangat Puas'];
                $surveiData = [$data['stp'], $data['tp'], $data['n'], $data['p'], $data['sp']];

                // Mendapatkan nama bulan berdasarkan nilai bulan yang dipilih
                $namaBulan = '';
                if (!empty($filterBulan)) {
                    $namaBulan = date('F', mktime(0, 0, 0, $filterBulan, 1));
                }

                // Mendapatkan nama bidang berdasarkan nilai bidang yang dipilih
                $namaBidang = '';
                if (!empty($filterBidang)) {
                    $qry_nama_bidang = mysqli_query($conn, "SELECT nama_bidang FROM bidang WHERE id_bidang = '$filterBidang'");
                    $data_nama_bidang = mysqli_fetch_assoc($qry_nama_bidang);
                    $namaBidang = $data_nama_bidang['nama_bidang'];
                }

                // Menyusun informasi yang akan ditampilkan pada grafik
                $infoGrafik = "$filterJenisSurvei $namaBidang Bulan $namaBulan Tahun $filterTahun";
                ?>

                <script>
                    // Mendefinisikan data untuk grafik
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode($labels); ?>,
                            datasets: [{
                                label: 'Jumlah Responden',
                                data: <?php echo json_encode($surveiData); ?>,
                                backgroundColor: ['red', 'orange', 'yellow', 'lightgreen', 'green'],
                                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 205, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            },
                            title: {
                                display: true,
                                text: '<?php echo $infoGrafik; ?>'
                            }
                        }
                    });

                    // Fungsi untuk mengonversi grafik menjadi gambar saat tombol unduh ditekan
                    document.getElementById("downloadBtn").addEventListener("click", function() {
                        var url_base64jp = document.getElementById("myChart").toDataURL("image/jpg");
                        var a = document.createElement('a');
                        a.href = url_base64jp;
                        a.download = 'grafik.jpg';
                        a.click();
                    });
                </script>
            <?php } ?>

    

        <!-- =========== Scripts =========  -->
        <script src="../assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        </div>
</body>

</html>
