<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Panggil Antrian</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "../config/database.php"; ?>
    <?php include 'layout_bidang.php'; ?>
    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>
        <div class="table">
            <h1>PANGGIL ANTRIAN</h1>

            <!-- ======================= PANGGIL ANTRIAN ================== -->
            <?php 
        $id_bidang = $_SESSION['id_bidang'];
        $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7); // Format tanggal
        
        // mengambil data id_antrian
        $antrian = mysqli_query($conn, "SELECT id_antrian, no_antrian FROM antrian  WHERE tanggal='$tanggal' AND id_bidang = '$id_bidang' AND status = 'belum'")
                                or die('Ada kesalahan pada query tampil data : ' . mysqli_error($conn));
        
        // mengambil data loket
        $loket = mysqli_query($conn, "SELECT id_loket, nama_loket FROM loket WHERE id_bidang = '$id_bidang' AND status = 'kosong'")
                                or die('Ada kesalahan pada query tampil data : ' . mysqli_error($conn));
        
        // Simpan nomor antrian dalam array
        $nomor_antrian_array = [];
        while ($row = mysqli_fetch_assoc($antrian)) {
            $nomor_antrian_array[] = array("id_antrian" => $row["id_antrian"], "no_antrian" => $row["no_antrian"]);
        }
        ?>
            <div class=" container-wrapper">
                <!-- panggil antrian -->
                <div class="container-tabel ">
                    <h2>Panggil Antrian</h2>
                    <table class="tabel-1">
                        <tr>
                            <th>
                                <label for="queue">Nomor Antrian</label>
                            </th>
                            <th>
                                <label for="counter">Loket</label>
                            </th>
                            <th>Panggil</th>
                        </tr>
                        <tr class="isiPanggilAntrian">
                            <td>
                                <?php
                            $index_antrian = isset($_GET['index']) ? intval($_GET['index']) : 0;

                            // Tampilkan nomor antrian beserta ID antriannya sesuai dengan indeks yang ditentukan
                            if (count($nomor_antrian_array) > 0 && $index_antrian >= 0 && $index_antrian < count($nomor_antrian_array)) {
                                echo "<input type='hidden' id='id_antrian' name='id_antrian' value='" . $nomor_antrian_array[$index_antrian]["id_antrian"] . "'>";
                                echo "<input type='hidden' id='no_antrian' name='no_antrian' value='" . $nomor_antrian_array[$index_antrian]["no_antrian"] . "'>";
                                echo "<div class='tamp-no-antrian'>";
                                echo "<h4>" . $nomor_antrian_array[$index_antrian]["no_antrian"] . "</h4>";
                                echo "</div>";

                            // Tampilkan tombol untuk melanjutkan atau mundur ke nomor antrian berikutnya atau sebelumnya
                                echo "<div class='buttonNextBack'>";
                                if ($index_antrian > 0) {
                                    // Jika bukan nomor antrian pertama, maka tombol "Back" akan ditampilkan
                                    echo "<a href='?index=" . ($index_antrian - 1) . "'><button class='back'>Back</button></a>";
                                } else {
                                    // Jika nomor antrian pertama, maka tombol "Back" akan dinonaktifkan
                                    echo "<button class='back disabled' style='opacity: 0.5; pointer-events: none;' disabled>Back</button>";
                                }
                                if ($index_antrian < count($nomor_antrian_array) - 1) {
                                    // Jika bukan nomor antrian terakhir, maka tombol "Next" akan ditampilkan
                                    echo "<a href='?index=" . ($index_antrian + 1) . "'><button class='next'>Next</button></a>";
                                } else {
                                    // Jika nomor antrian terakhir, maka tombol "Next" akan dinonaktifkan
                                    echo "<button class='next disabled' style='opacity: 0.5; pointer-events: none;' disabled>Next</button>";
                                }
                                echo "</div>";
                            } else {
                                // Tampilkan pesan jika tidak ada nomor antrian yang tersedia
                                echo "<div class='tamp-no-antrian'>";
                                echo "<h6>Tidak Ada Antrian</h6>";
                                echo "</div>";
                            }
    
                            ?>
                            </td>
                            <td>
                                <select id="id_loket" name="id_loket" onchange="addHiddenInput()">
                                    <option>Pilih Loket</option>
                                    <?php
                                while ($row = mysqli_fetch_array($loket)) {
                                    // Tampilkan opsi loket
                                    echo '<option value="' . $row['id_loket'] . '">' . $row['nama_loket'] . '</option>';
                                }
                                ?>
                                </select>
                                <input type="hidden" id="nama_loket_hidden" name="nama_loket">
                            </td>
                            <td>
                                <button id="bt-panggil" class="btn-circle" type="submit">
                                    <img src="../assets/imgs/mic.jpeg" alt="">
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- MENGAMBIL DATA ANTRIAN YANG TELAH DIPANGGIL -->
                <?php
            // mengambil data loket
            $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7); // Format tanggal

            $antrian_dipanggil = mysqli_query($conn, "SELECT antrian.id_antrian, antrian.no_antrian, antrian.id_loket, loket.nama_loket FROM antrian INNER JOIN loket ON antrian.id_loket = loket.id_loket  WHERE antrian.status = 'dipanggil' AND antrian.id_bidang = '$id_bidang' AND antrian.tanggal='$tanggal'")
                                or die('Ada kesalahan pada query tampil data : ' . mysqli_error($conn));
            ?>
                <!-- panggil ulang -->
                <div class="container-tabel">
                    <h2>Panggil Ulang</h2>
                    <table class="tabel-2 modif-tabel">
                        <tr>
                            <th>
                                <label for="queue">Nomor Antrian</label>
                            </th>
                            <th>Panggil</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <select id="ulang_id_antrian" name="ulang_id_antrian" onchange="addHiddenInput()">
                                        <option>Pilih Nomor Antrian</option>
                                        <?php
                                        while ($row = mysqli_fetch_array($antrian_dipanggil)) {
                                            echo '<option value="' . $row['id_antrian'] . '" data-nama_loket="' . $row['nama_loket'] . '">' . $row['no_antrian'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <!-- <input type="hidden" id="nama_loket1" name="nama_loket"> -->
                                </div>
                            </td>
                            <td>
                                <button id="bt-panggil-ulang" class="btn-circle" type="submit">
                                    <img src="../assets/imgs/mic.jpeg" alt="">
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- ============= TABEL =============== -->
            <div class="container-wrapper">
                <?php 
            $id_bidang = $_SESSION['id_bidang'];
            $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7); // Format tanggal
            
            $card_antrian = mysqli_query($conn, "SELECT antrian.id_antrian, antrian.no_antrian, loket.nama_loket, antrian.id_loket, antrian.status FROM antrian INNER JOIN loket ON antrian.id_loket = loket.id_loket WHERE tanggal='$tanggal' AND antrian.id_bidang = '$id_bidang' AND antrian.status = 'dipanggil' OR antrian.status = 'dipanggil ulang'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($conn));
            ?>

                <table class="content-table modif-tabel">
                    <thead>
                        <td>NO</td>
                        <td>Nomor Antrian</td>
                        <td>Loket</td>
                        <td>Status</td>
                        <td>Aksi</td>
                    </thead>
                    <?php
                $no = 1;
                while ($row = mysqli_fetch_array($card_antrian)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['no_antrian']; ?></td>
                        <td><?php echo $row['nama_loket']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><button id="selesai" class="selesai" data-id="<?php echo $row['id_antrian']; ?>"
                                data-id-loket="<?php echo $row['id_loket']; ?>">Selesai</button></td>
                    </tr>
                    <?php
                }
                ?>
                </table>
            </div>
        </div>
    </div>


    <!-- ====================== PANGGIL ANTRIAN ================ -->
    <script>
    var namaLoket; // Variabel untuk menyimpan nama loket secara global

    // Fungsi untuk menambahkan input hidden dengan nama loket
    function addHiddenInput() {
        // Mendapatkan elemen select berdasarkan ID
        var selectElement = document.getElementById('id_loket');

        // Mendapatkan nama loket dari opsi yang dipilih
        namaLoket = selectElement.options[selectElement.selectedIndex].text;

        // Mengatur nilai input hidden dengan nama loket yang dipilih
        document.getElementById('nama_loket_hidden').value = namaLoket;
    }

    $(document).ready(function() {
        // panggil antrian
        $('#bt-panggil').click(function(e) {
            e.preventDefault();
            var id_antrian = $('#id_antrian').val();
            var loket = $('#id_loket').val();

            // validasi agar antrian diisi
            if (id_antrian.trim() === '') {
                // Display an alert
                alert("ID Antrian harus diisi.");
                return; // Stop further execution
            }

            // validasi agar loket diisi
            if (isNaN(parseInt(loket))) {
                // Display an alert
                alert("Silahkan Pilih loket!");
                return; // Stop further execution
            }

            // Menampilkan nilai id_antrian dan loket di konsol
            console.log("ID Antrian: " + id_antrian);
            console.log("ID Loket: " + loket);

            // Memanggil fungsi addHiddenInput untuk mengupdate nama loket
            addHiddenInput();

            // Fungsi untuk memisahkan nomor antrian menjadi kode+angka
            function parseNomorAntrian(nomorAntrian) {
                // Mencocokkan kode dan angka menggunakan ekspresi reguler
                var match = nomorAntrian.match(/^([A-Za-z]+)(\d+)$/);

                // Jika pencocokan berhasil, match[1] akan berisi kode dan match[2] akan berisi angka
                if (match) {
                    var kodeantrian = match[1]; // Kode dari nomor antrian
                    var angka = parseInt(match[2], 10); // Angka dari nomor antrian

                    // Bulatkan angka jika diperlukan
                    if (angka < 10) {
                        angka = Math.round(angka);
                    } else if (angka < 100 && angka % 10 === 0) {
                        angka = Math.round(angka / 10) * 10;
                    }

                    return {
                        kode: kodeantrian,
                        angka: angka
                    };
                } else {
                    // Jika pencocokan gagal, kembalikan null atau lakukan penanganan kesalahan lainnya
                    return null;
                }
            }
            var audio = new Audio();

            function playAudio(source) {
                // Mendefinisikan variabel audio di sini
                audio.src = source;
                audio.load();
                audio.play();
            }

            function playAntrian(kodeantrian, angka, namaLoket) {
                var audioSources = [
                    '../assets/audio/opening.mp3',
                    '../assets/audio/nomor.mp3',
                    '../assets/audio/antrian.mp3',
                    '../assets/audio/' + kodeantrian + '.mp3', // Kodeantrian terlebih dahulu
                    // '../assets/audio/' + angka + '.mp3', // Angka berikutnya
                    '../assets/audio/diloket.mp3',
                    '../assets/audio/' + namaLoket + '.mp3'
                    // Tambahkan sumber audio lainnya sesuai kebutuhan
                ];

                // Tambahkan sumber audio untuk angka setelah sumber audio untuk kode
                if (angka < 10) {
                    console.log("kurang 10");
                    audioSources.splice(4, 0, '../assets/audio/' + angka + '.mp3');
                } else if (angka == 10) {
                    audioSources.splice(4, 0, '../assets/audio/10.mp3');
                } else if (angka == 11) {
                    console.log("sebelas");
                    audioSources.splice(4, 0, '../assets/audio/11.mp3');
                } else if (angka >= 12 && angka <= 19) {
                    console.log("belasan");
                    var puluhan = '../assets/audio/' + angka % 10 + '.mp3';
                    var belasan = '../assets/audio/belas.mp3';
                    audioSources.splice(4, 0, puluhan, belasan);
                } else if (angka == 20 || angka == 30 || angka == 40 || angka == 50 || angka == 60 ||
                    angka ==
                    70 || angka == 80 || angka == 90) {
                    console.log("puluhan");
                    var puluh = '../assets/audio/puluh.mp3';
                    audioSources.splice(4, 0, '../assets/audio/' + Math.floor(angka / 10) + '.mp3',
                        puluh);
                } else {
                    console.log("njir");
                    var puluhan = '../assets/audio/' + Math.floor(angka / 10) + '.mp3';
                    var puluh = '../assets/audio/puluh.mp3';
                    audioSources.splice(4, 0, puluhan, puluh, '../assets/audio/' + angka % 10 + '.mp3');
                }

                var currentIndex = 0; // Perlu di-reset setiap kali fungsi dipanggil

                function playNextAudio() {
                    if (currentIndex < audioSources.length) {
                        playAudio(audioSources[currentIndex]);
                        currentIndex++;
                    } else {
                        currentIndex = 0; // Reset index jika semua file audio telah diputar
                    }
                }

                // Panggil audio pertama
                playNextAudio();

                // Tambahkan event listener untuk kejadian 'ended'
                audio.addEventListener('ended', playNextAudio);
            }

            $.ajax({
                url: 'update.php',
                method: 'POST',
                data: {
                    id_antrian: id_antrian,
                    loket: loket
                },
                success: function(response) {
                    // inisialisasi no-antrian dan loket
                    var nomorAntrian = $('#no_antrian').val();
                    // var namaLoket = namaLoket;

                    // Menampilkan nilai nomor antrian dan loket ke konsol log
                    console.log("Nomor Antrian: " + nomorAntrian);
                    console.log("Nama Loket: " + namaLoket);

                    var hasilParsing = parseNomorAntrian(nomorAntrian);
                    var kodeantrian = hasilParsing ? hasilParsing.kode : null;
                    var angka = hasilParsing ? hasilParsing.angka : null;

                    if (hasilParsing) {
                        console.log("Kode: " + kodeantrian);
                        console.log("Angka: " + angka);
                        console.log("namaLoket: " + namaLoket);
                        playAntrian(kodeantrian, angka,
                            namaLoket
                        ); // Panggil fungsi playAntrian dengan parameter yang sesuai

                        // Tampilkan alert
                        alert("Nomor antrian " + nomorAntrian +
                            " berhasil dipanggil. Tunggu Sampai Antrian Selesai Dipanggil."
                        );

                        // Refresh halaman setelah 5 detik
                        setTimeout(function() {
                                location.reload();
                            },
                            100
                        );
                    } else {
                        console.log("Format nomor antrian tidak valid.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        });


        // PANGGIL ULANG ANTRIAN
        $('#bt-panggil-ulang').click(function(e) {
            e.preventDefault();
            // mengambil id antrian
            var id_antrian = $('#ulang_id_antrian').val();

            // mengambil nomor antrian
            var nomorAntrian1 = $('#ulang_id_antrian option:selected').text();

            // mengambil nama loket
            var selectedOption = $('#ulang_id_antrian option:selected');
            var namaLoket1 = selectedOption.data('nama_loket');
            $('#nama_loket1').val(namaLoket1);

            // Menampilkan nilai no_antrian dan loket di konsol
            console.log("ID Antrian: " + id_antrian);
            console.log("No Antrian: " + nomorAntrian1);
            console.log("Nama Loket: " + namaLoket1);

            // Lakukan AJAX untuk mengirim id_antrian ke update.php
            $.ajax({
                url: 'updateStatusDipanggilUlang.php',
                method: 'POST',
                data: {
                    id_antrian: id_antrian,
                },
                success: function(response) {
                    // Tampilkan pesan atau lakukan tindakan lain jika diperlukan
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            // Fungsi untuk memisahkan nomor antrian menjadi kode+angka
            function parseNomorAntrian1(nomorAntrian1) {
                // Mencocokkan kode dan angka menggunakan ekspresi reguler
                var match = nomorAntrian1.match(/^([A-Za-z]+)(\d+)$/);

                // Jika pencocokan berhasil, match[1] akan berisi kode dan match[2] akan berisi angka
                if (match) {
                    var kodeantrian1 = match[1]; // Kode dari nomor antrian
                    var angka1 = parseInt(match[2], 10); // Angka dari nomor antrian

                    // Bulatkan angka jika diperlukan
                    if (angka1 < 10) {
                        angka1 = Math.round(angka1);
                    } else if (angka1 < 100 && angka1 % 10 === 0) {
                        angka1 = Math.round(angka1 / 10) * 10;
                    }

                    return {
                        kode1: kodeantrian1,
                        angka1: angka1
                    };
                } else {
                    // Jika pencocokan gagal, kembalikan null atau lakukan penanganan kesalahan lainnya
                    return null;
                }
            }

            var audio = new Audio();

            function playAudio1(source) {
                // Mendefinisikan variabel audio di sini
                audio.src = source;
                audio.load();
                audio.play();
            }

            function playAntrian1(kodeantrian1, angka1, namaLoket1) {
                var audioSources = [
                    '../assets/audio/opening.mp3',
                    '../assets/audio/nomor.mp3',
                    '../assets/audio/antrian.mp3',
                    '../assets/audio/' + kodeantrian1 + '.mp3',
                    '../assets/audio/diloket.mp3',
                    '../assets/audio/' + namaLoket1 + '.mp3'
                    // Tambahkan sumber audio lainnya sesuai kebutuhan
                ];

                // Tambahkan sumber audio untuk angka setelah sumber audio untuk kode
                if (angka1 < 10) {
                    console.log("kurang dari 10");
                    audioSources.splice(4, 0, '../assets/audio/' + angka1 + '.mp3');
                } else if (angka1 == 10) {
                    audioSources.splice(4, 0, '../assets/audio/10.mp3');
                } else if (angka1 == 11) {
                    console.log("sebelas");
                    audioSources.splice(4, 0, '../assets/audio/11.mp3');
                } else if (angka1 >= 12 && angka1 <= 19) {
                    console.log("belasan");
                    var puluhan = '../assets/audio/' + angka1 % 10 + '.mp3';
                    var belasan = '../assets/audio/belas.mp3';
                    audioSources.splice(4, 0, puluhan, belasan);
                } else if (angka1 == 20 || angka1 == 30 || angka1 == 40 || angka1 == 50 || angka1 ==
                    60 ||
                    angka1 ==
                    70 || angka1 == 80 || angka1 == 90) {
                    console.log("puluhan");
                    var puluh = '../assets/audio/puluh.mp3';
                    audioSources.splice(4, 0, '../assets/audio/' + Math.floor(angka1 / 10) + '.mp3',
                        puluh);
                } else {
                    console.log("njir");
                    var puluhan = '../assets/audio/' + Math.floor(angka1 / 10) + '.mp3';
                    var puluh = '../assets/audio/puluh.mp3';
                    audioSources.splice(4, 0, puluhan, puluh, '../assets/audio/' + angka1 % 10 +
                    '.mp3');
                }

                var currentIndex = 0; // Perlu di-reset setiap kali fungsi dipanggil

                function playNextAudio1() {
                    if (currentIndex < audioSources.length) {
                        playAudio1(audioSources[currentIndex]);
                        currentIndex++;
                    } else {
                        currentIndex = 0; // Reset index jika semua file audio telah diputar
                    }
                }

                // Panggil audio pertama
                playNextAudio1();

                // Tambahkan event listener untuk kejadian 'ended'
                audio.addEventListener('ended', playNextAudio1); // Perbaikan disini
            }

            var hasilParsing1 = parseNomorAntrian1(nomorAntrian1);
            var kodeantrian1 = hasilParsing1 ? hasilParsing1.kode1 : null;
            var angka1 = hasilParsing1 ? hasilParsing1.angka1 : null;

            if (hasilParsing1) {
                console.log("Kode: " + kodeantrian1);
                console.log("Angka: " + angka1);
                console.log("namaLoket: " + namaLoket1);
                playAntrian1(kodeantrian1, angka1,
                    namaLoket1); // Panggil fungsi playAntrian dengan parameter yang sesuai

                // Tampilkan alert
                alert("Nomor antrian " + nomorAntrian1 +
                    " berhasil dipanggil ulang. Tunggu Sampai Antrian Selesai Dipanggil.");

                // Setelah alert ditutup, refresh halaman setelah 1 detik
                setTimeout(function() {
                    location.reload();
                }, 100);
            } else {
                console.log("Format nomor antrian tidak valid.");
            }
        });




        // ANTRIAN SELESAI
        $('.selesai').click(function(e) {
            e.preventDefault();
            var id_antrian = $(this).data('id');
            var id_loket = $(this).data('id-loket');

            console.log("ID Antrian: " + id_antrian);
            console.log("ID Loket: " + id_loket);
            $.ajax({
                type: 'POST',
                url: 'updateStatusAntrian.php',
                data: {
                    id_antrian: id_antrian,
                    loket: id_loket
                },
                success: function(response) {
                    console.log(response); // Log the response

                    // Setelah alert ditutup, refresh halaman setelah 1 detik
                    setTimeout(function() {
                        location.reload();
                    }, 100);
                },

                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Tangani kesalahan jika ada
                }
            });
        });
    });
    </script>




    <!-- jQuery Core -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>

    <!-- DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <!-- Responsivevoice -->
    <!-- Get API Key -> https://responsivevoice.org/ -->
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>
    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!-- <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->

</body>

</html>