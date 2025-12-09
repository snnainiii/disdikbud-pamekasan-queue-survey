<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Survei</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<style>
.survei {
    margin-top: 20px;
}

.chart-container {
    /* background-color: #f2f3f4; */

    width: calc(33.33% - 20px);
    float: left;
    max-width: 500px;
    margin: auto;
    margin-bottom: 20px;
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 20px;
    border: 0.2px #808080 solid;
    border-radius: 2px;
    margin-right: 20px;
    padding: 10px;
}

canvas {
    width: 100% !important;
    height: auto !important;
}

.chart-ket {
    border: none;
    margin-bottom: 50px;

}

.chart-ket td {
    font-size: 14px;
    font-weight: 450;
    margin-top: -12px;
    margin: 10px;
    color: #6b6b6b;
    padding: 2px;
}

.ket {
    font-size: 15px;
    font-weight: 450;
    margin-top: -12px;
}

.catatan-survei {
    text-align: left;
    font-weight: 100;
    /* margin-top: -10px; */
}
</style>

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
        <div class="table">
            <?php
            $id_bidang = $_GET['id_bidang'];
            $data = mysqli_query($conn, "SELECT * FROM bidang WHERE id_bidang ='$id_bidang'");
            while ($tampil = mysqli_fetch_array($data)) { 
                echo "<h1>GRAFIK SURVEI " . $tampil['nama_bidang'] . "</h1>";
            }
            ?>

            <!-- ======================= GRAFIK SURVEI INTERAKSI ================== -->
            <div class=" survei survei-interaksi">
                <div class="chart-container">
                    <canvas id="myChart1"></canvas>
                </div>
                <?php
                $id_bidang = $_GET['id_bidang'];
            // Query untuk data grafik
                $queryCategories1 = "SELECT 
                                        SUM(survei_interaksi='Sangat Puas') as sp,
                                        SUM(survei_interaksi='Puas') as p,
                                        SUM(survei_interaksi='Netral') as n,
                                        SUM(survei_interaksi='Tidak Puas') as tp,
                                        SUM(survei_interaksi='Sangat Tidak Puas') as stp
                                    FROM survei 
                                    WHERE id_bidang = '$id_bidang'";
            
            $resultCategories1 = mysqli_query($conn, $queryCategories1);
            $dataCategories1 = mysqli_fetch_assoc($resultCategories1);
            $Categories1 = array('Sangat Puas', 'Puas', 'Netral', 'Tidak Puas', 'Sangat Tidak Puas');
            $categoryValues1 = array($dataCategories1['sp'], $dataCategories1['p'], $dataCategories1['n'], $dataCategories1['tp'], $dataCategories1['stp']);
            ?>
                <script>
                var xValues1 = ['STP', 'TP', 'N', 'P', 'SP'];
                var yValues1 = <?php echo json_encode($categoryValues1); ?>;
                var barColors = ["red", "orange", "yellow", "lightgreen", "green"];
                var ctx = document.getElementById('myChart1').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: xValues1,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues1
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: "Grafik Survei Interaksi"
                        }
                    }
                });
                </script>
            </div>

            <!-- ======================= GRAFIK SURVEI CEPAT ================== -->
            <div class=" survei survei-cepat">
                <div class="chart-container">
                    <canvas id="myChart2"></canvas>
                </div>

                <?php
                $id_bidang = $_GET['id_bidang'];

                // Query untuk data grafik
                $queryCategories2 = "SELECT 
                                        SUM(survei_cepat='Sangat Puas') as sp,
                                        SUM(survei_cepat='Puas') as p,
                                        SUM(survei_cepat='Netral') as n,
                                        SUM(survei_cepat='Tidak Puas') as tp,
                                        SUM(survei_cepat='Sangat Tidak Puas') as stp
                                    FROM survei 
                                    WHERE id_bidang = '$id_bidang'";

                $resultCategories2 = mysqli_query($conn, $queryCategories2);
                $dataCategories2 = mysqli_fetch_assoc($resultCategories2);

                $categories2 = array('Sangat Tidak Puas', 'Tidak Puas', 'Netral', 'Puas', 'Sangat Puas');
                $categoryValues2 = array($dataCategories2['stp'], $dataCategories2['tp'], $dataCategories2['n'], $dataCategories2['p'], $dataCategories2['sp']);
                ?>

                <script>
                var xValues2 = ['STP', 'TP', 'N', 'P', 'SP'];
                var yValues2 = <?php echo json_encode($categoryValues2); ?>;
                var barColors2 = ["red", "orange", "yellow", "lightgreen", "green"];

                new Chart("myChart2", {
                    type: "bar",
                    data: {
                        labels: xValues2,
                        datasets: [{
                            backgroundColor: barColors2,
                            data: yValues2
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: "Grafik Survei Cepat", // Judul grafik
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                </script>
            </div>

            <!-- ======================= GRAFIK SURVEI TEPAT ================== -->
            <div class="survei survei-tepat">
                <div class="chart-container">
                    <canvas id="myChart3"></canvas>
                </div>

                <?php
                $id_bidang = $_GET['id_bidang'];

                // Query untuk data grafik
                $queryCategories3 = "SELECT 
                                        SUM(survei_tepat='Sangat Puas') as sp,
                                        SUM(survei_tepat='Puas') as p,
                                        SUM(survei_tepat='Netral') as n,
                                        SUM(survei_tepat='Tidak Puas') as tp,
                                        SUM(survei_tepat='Sangat Tidak Puas') as stp
                                    FROM survei 
                                    WHERE id_bidang = '$id_bidang'";

                $resultCategories3 = mysqli_query($conn, $queryCategories3);
                $dataCategories3 = mysqli_fetch_assoc($resultCategories3);

                $categories3 = array('Sangat Tidak Puas', 'Tidak Puas', 'Netral', 'Puas', 'Sangat Puas');
                $categoryValues3 = array($dataCategories3['stp'], $dataCategories3['tp'], $dataCategories3['n'], $dataCategories3['p'], $dataCategories3['sp']);
                ?>

                <script>
                var xValues3 = ['STP', 'TP', 'N', 'P', 'SP'];
                var yValues3 = <?php echo json_encode($categoryValues3); ?>;
                var barColors3 = ["red", "orange", "yellow", "lightgreen", "green"];

                new Chart("myChart3", {
                    type: "bar",
                    data: {
                        labels: xValues3,
                        datasets: [{
                            backgroundColor: barColors3,
                            data: yValues3
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: "Grafik Survei Tepat", // Judul grafik

                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                </script>
            </div>

            <!-- ======================= GRAFIK SURVEI MASALAH ================== -->
            <div class="survei survei-masalah">
                <div class="chart-container">
                    <canvas id="myChart4"></canvas>
                </div>

                <?php
            $id_bidang = $_GET['id_bidang'];

            // Query untuk data grafik
            $queryCategories4 = "SELECT 
                                    SUM(survei_masalah='Sangat Puas') as sp,
                                    SUM(survei_masalah='Puas') as p,
                                    SUM(survei_masalah='Netral') as n,
                                    SUM(survei_masalah='Tidak Puas') as tp,
                                    SUM(survei_masalah='Sangat Tidak Puas') as stp
                                FROM survei 
                                WHERE id_bidang = '$id_bidang'";

            $resultCategories4 = mysqli_query($conn, $queryCategories4);
            $dataCategories4 = mysqli_fetch_assoc($resultCategories4);

            $categories4 = array('Sangat Tidak Puas', 'Tidak Puas', 'Netral', 'Puas', 'Sangat Puas');
            $categoryValues4 = array($dataCategories4['stp'], $dataCategories4['tp'], $dataCategories4['n'], $dataCategories4['p'], $dataCategories4['sp']);
            ?>

                <script>
                var xValues4 = ['STP', 'TP', 'N', 'P', 'SP'];
                var yValues4 = <?php echo json_encode($categoryValues4); ?>;
                var barColors4 = ["red", "orange", "yellow", "lightgreen", "green"];

                new Chart("myChart4", {
                    type: "bar",
                    data: {
                        labels: xValues4,
                        datasets: [{
                            backgroundColor: barColors4,
                            data: yValues4
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: "Grafik Survei Masalah", // Judul grafik

                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                </script>
            </div>

            <!-- ======================= GRAFIK SURVEI KESALAHAN ================== -->
            <div class=" survei survei-kesalahan">
                <div class="chart-container">
                    <canvas id="myChart5"></canvas>
                </div>

                <?php
            $id_bidang = $_GET['id_bidang'];

            // Query untuk data grafik
            $queryCategories5 = "SELECT 
                                    SUM(survei_kesalahan='Sangat Puas') as sp,
                                    SUM(survei_kesalahan='Puas') as p,
                                    SUM(survei_kesalahan='Netral') as n,
                                    SUM(survei_kesalahan='Tidak Puas') as tp,
                                    SUM(survei_kesalahan='Sangat Tidak Puas') as stp
                                FROM survei 
                                WHERE id_bidang = '$id_bidang'";

            $resultCategories5 = mysqli_query($conn, $queryCategories5);
            $dataCategories5 = mysqli_fetch_assoc($resultCategories5);

            $categories5 = array('Sangat Tidak Puas', 'Tidak Puas', 'Netral', 'Puas', 'Sangat Puas');
            $categoryValues5 = array($dataCategories5['stp'], $dataCategories5['tp'], $dataCategories5['n'], $dataCategories5['p'], $dataCategories5['sp']);
            ?>

                <script>
                var xValues5 = ['STP', 'TP', 'N', 'P', 'SP'];
                var yValues5 = <?php echo json_encode($categoryValues5); ?>;
                var barColors5 = ["red", "orange", "yellow", "lightgreen", "green"];

                new Chart("myChart5", {
                    type: "bar",
                    data: {
                        labels: xValues5,
                        datasets: [{
                            backgroundColor: barColors5,
                            data: yValues5
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: "Grafik Survei Kesalahan", // Judul grafik
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                </script>
            </div>

            <div class="survei survei-ket ">
                <div class="chart-container chart-ket">
                    <table class="">
                        <tr>
                            <td class="ket" colspan="3">Keterangan</td>
                            <!-- <td>:</td>
                            <td>Sangat Tidak Puas</td> -->
                        </tr>
                        <tr>
                            <td>STP</td>
                            <td>:</td>
                            <td>Sangat Tidak Puas</td>
                        </tr>
                        <tr>
                            <td>TP</td>
                            <td>:</td>
                            <td>Tidak Puas</td>
                        </tr>
                        <tr>
                            <td>N</td>
                            <td>:</td>
                            <td>Netral</td>
                        </tr>
                        <tr>
                            <td>P</td>
                            <td>:</td>
                            <td>Puas</td>
                        </tr>
                        <tr>
                            <td>SP</td>
                            <td>:</td>
                            <td>Sangat Puas</td>
                        </tr>
                    </table>
                    <br>
                </div>
            </div>
            <!-- table 2 -->
            <!-- <h1>jjjj</h1> -->
            <div class=" catatan-survei">
                <p class="ket">Keterangan</p>
                <p>* Survei Interaksi : Interaksi dengan petugas layanan, apakah mereka ramah,
                    membantu, dan sopan?</p>
                <p>* Survei Cepat : Apakah petugas memberikan pelayanan secara cepat?</p>
                <p>* Survei Tepat : Apakah petugas memberikan pelayanan secara tepat sejak
                    awal?</p>
                <p>* Survei Masalah : Jika anda memiliki masalah, apakah petugas
                    bersungguh-sungguh
                    berusaha
                    membantu
                    memecahkan masalah tersebut?</p>
                <p>* Survei Kesalahan : Apakah petugas selalu berusaha meminimalisir
                    kesalahan
                    pada
                    pelayanan yang
                    diberikan?</p>
            </div>

        </div>

        <!-- =========== Scripts =========  -->
        <script src="../assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>



    </div>

    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!-- <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->

</body>

</html>