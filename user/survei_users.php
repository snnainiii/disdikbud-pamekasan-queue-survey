<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="..\assets\css\main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<style>
body {
    background-image: url(../assets/imgs/bg.jpeg);
    background-repeat: no-repeat;
    background-size: cover;
}

.kotak {
    width: 800px;
    height: 680px;
    background-color: #ffffff;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 2px;
    padding: 25px;
}

.judul-rating h3 {
    font-size: 23px;
    margin-bottom: 20px;
}

.judul-rating p {
    margin-bottom: 25px;
}

.isi-survei img {
    width: 42px;
    height: auto;
    cursor: pointer;
    margin-bottom: -35px;
}

.rating-label {
    position: relative;
    display: inline-block;
}

.isi-survei {
    display: flex;
    justify-content: space-between;
}

.rating-smile {
    flex: 1;
    text-align: center;
    margin-bottom: 15px;
    margin-left: -30px;
}

.rating-smile p {
    font-size: 10px;
    text-align: center;
    margin-top: 37px;
}


/* HOVER EMOTICON*/


/* Menyembunyikan gambar kedua secara default */

.rating-label img:last-child {
    display: none;
}


/* Menampilkan gambar kedua saat label dihover */

.rating-label:hover img:last-child {
    display: inline;
}


/* Menyembunyikan gambar pertama saat label dihover */

.rating-label:hover img:first-child {
    display: none;
}
.submit-buttons {
    display: flex;
    justify-content: space-between;
}

.submit-rating {
    margin-top: 15px;
    margin-left: 9px;
    width: 370px;
    height: 40px;
    text-align: center;
    border-radius: 0;
    border-radius: 5px;
}
</style>

<body>

    <!-- ======================= Tabel ================== -->
    <div class="kotak">
        <div class="judul-rating">
            <h3>Ratingmu, Pedoman Perbaikan: Bersama Menuju Pelayanan Terbaik!</h3>
            <!-- <p>BERI RATING BAGAIMANA PELAYANAN INI</p> -->
        </div>
        <!-- ==================== SURVEI INTERAKSI ============  -->
        <form action="#" method="POST">

            <div class="isi">
                <div class="survei survei-interaksi" id="survei-interaksi">
                    <div class="judul-survei">
                        <label for="survei_interaksi">Interaksi dengan petugas layanan, apakah mereka ramah,
                            membantu, dan sopan?</label>
                    </div>
                    <div class="isi-survei" id="isi-survei-interaksi">
                        <!-- sangat tidak puas -->
                        <div class="rating-smile">
                            <label for="rating1_sangat_tidak_puas" value="Sangat Tidak Puas"
                                id="rating1_sangat_tidak_puas" class="rating-label" name="survei_interaksi">
                                <img src="../assets/imgs/half_sangat_tidak_puas.png" alt="Sangat Tidak Puas">
                                <img src="../assets/imgs/full_sangat_tidak_puas.png" alt="Sangat Tidak Puas"
                                    onclick="setRating('sangat Tidak Puas', this)" value="Sangat Tidak Puas"
                                    id="rating1_sangat_tidak_puas">
                            </label>
                            <p>Sangat Tidak Puas</p>
                        </div>

                        <!-- tidak puas -->
                        <div class="rating-smile">
                            <label for="rating1_tidak_puas" value="Tidak Puas" id="rating1_tidak_puas"
                                class="rating-label" name="survei_interaksi">
                                <img src="../assets/imgs/half_tidak_puas.png" alt="Tidak Puas">
                                <img src="../assets/imgs/full_tidak_puas.png" alt="Tidak Puas"
                                    onclick="setRating('Tidak Puas', this)" value="Tidak Puas" id="rating1_tidak_puas">
                            </label>
                            <p>Tidak Puas</p>
                        </div>

                        <!-- netral -->
                        <div class="rating-smile">
                            <label for="rating1_netral" value="Netral" id="rating1_netral" class="rating-label"
                                name="survei_interaksi">
                                <img src="../assets/imgs/half_netral.png" alt="Netral">
                                <img src="../assets/imgs/full_netral.png" alt="Netral"
                                    onclick="setRating('Netral', this)" value="Netral" id="rating1_netral">
                            </label>
                            <p>Netral</p>
                        </div>

                        <!-- puas -->
                        <div class="rating-smile">
                            <label for="rating1_puas" value="Puas" id="rating1_puas" class="rating-label"
                                name="survei_interaksi">
                                <img src="../assets/imgs/half_puas.png" alt="Puas">
                                <img src="../assets/imgs/full_puas.png" alt="Puas" onclick="setRating('Puas', this)"
                                    value="Puas" id="rating1_puas">
                            </label>
                            <p>Puas</p>
                        </div>

                        <!-- sangat puas -->
                        <div class="rating-smile">
                            <label for="rating1_sangat_puas" value="Sangat Puas" id="rating1_sangat_puas"
                                class="rating-label" name="survei_interaksi">
                                <img src="../assets/imgs/half_sangat_puas.png" alt="Sangat Puas" ">
                            <img src=" ../assets/imgs/full_sangat_puas.png" alt="Sangat Puas"
                                    onclick="setRating('Sangat Puas', this)" value="Sangat Puas"
                                    id="rating1_sangat_puas">
                            </label>
                            <p>Sangat Puas</p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- ============= SURVEI CEPAT ============== -->
            <div class="isi">
                <div class="survei survei-cepat" id="survei-cepat">
                    <div class="judul-survei">
                        <label for="survei_cepat">Apakah petugas memberikan pelayanan secara cepat?</label>
                    </div>
                    <div class="isi-survei" id="isi-survei-cepat">
                        <!-- sangat tidak puas -->
                        <div class="rating-smile">
                            <label for="rating2_sangat_tidak_puas" value="Sangat Tidak Puas"
                                id="rating2_sangat_tidak_puas" class="rating-label" name="survei_cepat">
                                <img src="../assets/imgs/half_sangat_tidak_puas.png" alt="Sangat Tidak Puas">
                                <img src="../assets/imgs/full_sangat_tidak_puas.png" alt="Sangat Tidak Puas"
                                    onclick="setRating('sangat Tidak Puas', this)" value="Sangat Tidak Puas"
                                    id="rating2_sangat_tidak_puas">
                            </label>
                            <p>Sangat Tidak Puas</p>
                        </div>

                        <!-- tidak puas -->
                        <div class="rating-smile">
                            <label for="rating2_tidak_puas" value="Tidak Puas" id="rating2_tidak_puas"
                                class="rating-label" name="survei_cepat">
                                <img src="../assets/imgs/half_tidak_puas.png" alt="Tidak Puas">
                                <img src="../assets/imgs/full_tidak_puas.png" alt="Tidak Puas"
                                    onclick="setRating('Tidak Puas', this)" value="Tidak Puas" id="rating2_tidak_puas">
                            </label>
                            <p>Tidak Puas</p>
                        </div>

                        <!-- netral -->
                        <div class="rating-smile">
                            <label for="rating2_netral" value="Netral" id="rating2_netral" class="rating-label"
                                name="survei_cepat">
                                <img src="../assets/imgs/half_netral.png" alt="Netral">
                                <img src="../assets/imgs/full_netral.png" alt="Netral"
                                    onclick="setRating('Netral', this)" value="Netral" id="rating2_netral">
                            </label>
                            <p>Netral</p>
                        </div>

                        <!-- puas -->
                        <div class="rating-smile">
                            <label for="rating2_puas" value="Puas" id="rating2_puas" class="rating-label"
                                name="survei_cepat">
                                <img src="../assets/imgs/half_puas.png" alt="Puas">
                                <img src="../assets/imgs/full_puas.png" alt="Puas" onclick="setRating('Puas', this)"
                                    value="Puas" id="rating2_puas">
                            </label>
                            <p>Puas</p>
                        </div>

                        <!-- sangat puas -->
                        <div class="rating-smile">
                            <label for="rating2_sangat_puas" value="Sangat Puas" id="rating2_sangat_puas"
                                class="rating-label" name="survei_cepat">
                                <img src="../assets/imgs/half_sangat_puas.png" alt="Sangat Puas">
                                <img src="../assets/imgs/full_sangat_puas.png" alt="Sangat Puas"
                                    onclick="setRating('Sangat Puas', this)" value="Sangat Puas"
                                    id="rating2_sangat_puas">
                            </label>
                            <p>Sangat Puas</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============= SURVEI TEPAT============== -->
            <div class="isi">
                <div class="survei survei-tepat" id="survei-tepat">
                    <div class="judul-survei">
                        <label for="survei_tepat">Apakah petugas memberikan pelayanan secara tepat sejak
                            awal?</label>
                    </div>
                    <div class="isi-survei" id="isi-survei-tepat">
                        <!-- sangat tidak puas -->
                        <div class="rating-smile">
                            <label for="rating3_sangat_tidak_puas" value="Sangat Tidak Puas"
                                id="rating3_sangat_tidak_puas" class="rating-label" name="survei_tepat">
                                <img src="../assets/imgs/half_sangat_tidak_puas.png" alt="Sangat Tidak Puas">
                                <img src="../assets/imgs/full_sangat_tidak_puas.png" alt="Sangat Tidak Puas"
                                    onclick="setRating('sangat Tidak Puas', this)" value="Sangat Tidak Puas"
                                    id="rating3_sangat_tidak_puas">
                            </label>
                            <p>Sangat Tidak Puas</p>
                        </div>

                        <!-- tidak puas -->
                        <div class="rating-smile">
                            <label for="rating3_tidak_puas" value="Tidak Puas" id="rating3_tidak_puas"
                                class="rating-label" name="survei_tepat">
                                <img src="../assets/imgs/half_tidak_puas.png" alt="Tidak Puas">
                                <img src="../assets/imgs/full_tidak_puas.png" alt="Tidak Puas"
                                    onclick="setRating('Tidak Puas', this)" value="Tidak Puas" id="rating3_tidak_puas">
                            </label>
                            <p>Tidak Puas</p>
                        </div>

                        <!-- netral -->
                        <div class="rating-smile">
                            <label for="rating3_netral" value="Netral" id="rating3_netral" class="rating-label"
                                name="survei_tepat">
                                <img src="../assets/imgs/half_netral.png" alt="Netral">
                                <img src="../assets/imgs/full_netral.png" alt="Netral"
                                    onclick="setRating('Netral', this)" value="Netral" id="rating3_netral">
                            </label>
                            <p>Netral</p>
                        </div>

                        <!-- puas -->
                        <div class="rating-smile">
                            <label for="rating3_puas" value="Puas" id="rating3_puas" class="rating-label"
                                name="survei_tepat">
                                <img src="../assets/imgs/half_puas.png" alt="Puas">
                                <img src="../assets/imgs/full_puas.png" alt="Puas" onclick="setRating('Puas', this)"
                                    value="Puas" id="rating3_puas">
                            </label>
                            <p>Puas</p>
                        </div>

                        <!-- sangat puas -->
                        <div class="rating-smile">
                            <label for="rating3_sangat_puas" value="Sangat Puas" id="rating3_sangat_puas"
                                class="rating-label" name="survei_tepat">
                                <img src="../assets/imgs/half_sangat_puas.png" alt="Sangat Puas">
                                <img src="../assets/imgs/full_sangat_puas.png" alt="Sangat Puas"
                                    onclick="setRating('Sangat Puas', this)" value="Sangat Puas"
                                    id="rating3_sangat_puas">
                            </label>
                            <p>Sangat Puas</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============= SURVEI MASALALH ============== -->
            <div class="isi">
                <div class="survei survei-masalah" id="survei-masalah">
                    <div class="judul-survei">
                        <label for="survei_masalah">Jika anda memiliki masalah, apakah petugas
                            bersungguh-sungguh
                            berusaha
                            membantu
                            memecahkan masalah tersebut?</label>
                    </div>
                    <div class="isi-survei" id="isi-survei-masalah">
                        <!-- sangat tidak puas -->
                        <div class="rating-smile">
                            <label for="rating4_sangat_tidak_puas" value="Sangat Tidak Puas"
                                id="rating4_sangat_tidak_puas" class="rating-label" name="survei_masalah">
                                <img src="../assets/imgs/half_sangat_tidak_puas.png" alt="Sangat Tidak Puas">
                                <img src="../assets/imgs/full_sangat_tidak_puas.png" alt="Sangat Tidak Puas"
                                    onclick="setRating('sangat Tidak Puas', this)" value="Sangat Tidak Puas"
                                    id="rating4_sangat_tidak_puas">
                            </label>
                            <p>Sangat Tidak Puas</p>
                        </div>

                        <!-- tidak puas -->
                        <div class="rating-smile">
                            <label for="rating4_tidak_puas" value="Tidak Puas" id="rating4_tidak_puas"
                                class="rating-label" name="survei_masalah">
                                <img src="../assets/imgs/half_tidak_puas.png" alt="Tidak Puas">
                                <img src="../assets/imgs/full_tidak_puas.png" alt="Tidak Puas"
                                    onclick="setRating('Tidak Puas', this)" value="Tidak Puas" id="rating4_tidak_puas">
                            </label>
                            <p>Tidak Puas</p>
                        </div>

                        <!-- netral -->
                        <div class="rating-smile">
                            <label for="rating4_netral" value="Netral" id="rating4_netral" class="rating-label"
                                name="survei_masalah">
                                <img src="../assets/imgs/half_netral.png" alt="Netral">
                                <img src="../assets/imgs/full_netral.png" alt="Netral"
                                    onclick="setRating('Netral', this)" value="Netral" id="rating4_netral">
                            </label>
                            <p>Netral</p>
                        </div>

                        <!-- puas -->
                        <div class="rating-smile">
                            <label for="rating4_puas" value="Puas" id="rating4_puas" class="rating-label"
                                name="survei_masalah">
                                <img src="../assets/imgs/half_puas.png" alt="Puas">
                                <img src="../assets/imgs/full_puas.png" alt="Puas" onclick="setRating('Puas', this)"
                                    value="Puas" id="rating4_puas">
                            </label>
                            <p>Puas</p>
                        </div>

                        <!-- sangat puas -->
                        <div class="rating-smile">
                            <label for="rating4_sangat_puas" value="Sangat Puas" id="rating4_sangat_puas"
                                class="rating-label" name="survei_masalah">
                                <img src="../assets/imgs/half_sangat_puas.png" alt="Sangat Puas">
                                <img src="../assets/imgs/full_sangat_puas.png" alt="Sangat Puas"
                                    onclick="setRating('Sangat Puas', this)" value="Sangat Puas"
                                    id="rating4_sangat_puas">
                            </label>
                            <p>Sangat Puas</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============= SURVEI KESALAHAN ============== -->
            <div class="isi">
                <div class="survei survei-kesalahan" id="survei-kesalahan">
                    <div class="judul-survei">
                        <label for="survei_kesalahan">Apakah petugas selalu berusaha meminimalisir
                            kesalahan
                            pada
                            pelayanan yang
                            diberikan?</label>
                    </div>
                    <div class="isi-survei" id="isi-survei-kesalahan">
                        <!-- sangat tidak puas -->
                        <div class="rating-smile">
                            <label for="rating5_sangat_tidak_puas" value="Sangat Tidak Puas"
                                id="rating5_sangat_tidak_puas" class="rating-label" name="survei_kesalahan">
                                <img src="../assets/imgs/half_sangat_tidak_puas.png" alt="Sangat Tidak Puas">
                                <img src="../assets/imgs/full_sangat_tidak_puas.png" alt="Sangat Tidak Puas"
                                    onclick="setRating('sangat Tidak Puas', this)" value="Sangat Tidak Puas"
                                    id="rating5_sangat_tidak_puas">
                            </label>
                            <p>Sangat Tidak Puas</p>
                        </div>

                        <!-- tidak puas -->
                        <div class="rating-smile">
                            <label for="rating5_tidak_puas" value="Tidak Puas" id="rating5_tidak_puas"
                                class="rating-label" name="survei_kesalahan">
                                <img src="../assets/imgs/half_tidak_puas.png" alt="Tidak Puas">
                                <img src="../assets/imgs/full_tidak_puas.png" alt="Tidak Puas"
                                    onclick="setRating('Tidak Puas', this)" value="Tidak Puas" id="rating5_tidak_puas">
                            </label>
                            <p>Tidak Puas</p>
                        </div>

                        <!-- netral -->
                        <div class="rating-smile">
                            <label for="rating5_netral" value="Netral" id="rating5_netral" class="rating-label"
                                name="survei_kesalahan">
                                <img src="../assets/imgs/half_netral.png" alt="Netral">
                                <img src="../assets/imgs/full_netral.png" alt="Netral"
                                    onclick="setRating('Netral', this)" value="Netral" id="rating5_netral">
                            </label>
                            <p>Netral</p>
                        </div>

                        <!-- puas -->
                        <div class="rating-smile">
                            <label for="rating5_puas" value="Puas" id="rating5_puas" class="rating-label"
                                name="survei_kesalahan">
                                <img src="../assets/imgs/half_puas.png" alt="Puas">
                                <img src="../assets/imgs/full_puas.png" alt="Puas" onclick="setRating('Puas', this)"
                                    value="Puas" id="rating5_puas">
                            </label>
                            <p>Puas</p>
                        </div>

                        <!-- sangat puas -->
                        <div class="rating-smile">
                            <label for="rating5_sangat_puas" value="Sangat Puas" id="rating5_sangat_puas"
                                class="rating-label" name="survei_kesalahan">
                                <img src="../assets/imgs/half_sangat_puas.png" alt="Sangat Puas">
                                <img src="../assets/imgs/full_sangat_puas.png" alt="Sangat Puas"
                                    onclick="setRating('Sangat Puas', this)" value="Sangat Puas"
                                    id="rating5_sangat_puas">
                            </label>
                            <p>Sangat Puas</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========== SUBMIT =========== -->
            <div class="submit-buttons">
                <button class="submit-rating" onclick="goBack()">Kembali</button>
                <button name="submit" id="submit" class="submit-rating">Submit</button>

            </div>

        </form>
        <script>
            function goBack() {
            window.history.back();
            }
            </script>


    </div>
    <script>
    var surveyResponses = {};

    // Mengambil semua kelompok survei
    var surveyGroups = document.querySelectorAll('.survei');

    // Menangani peristiwa klik pada setiap kelompok survei
    surveyGroups.forEach(function(group) {
        var ratingLabels = group.querySelectorAll('.rating-label');
        ratingLabels.forEach(function(label) {
            label.addEventListener('click', function() {
                // Mengubah semua gambar pada kelompok survei menjadi versi setengah
                var allImages = group.querySelectorAll('img');
                allImages.forEach(function(img) {
                    img.src = img.src.replace('full_', 'half_');
                });

                // Mengubah semua gambar pada label yang diklik menjadi gambar yang penuh
                var images = label.querySelectorAll('img');
                images.forEach(function(img) {
                    img.src = img.src.replace('half_', 'full_');
                });

                // Mendapatkan nama survei dari atribut name pada label
                var surveyName = label.getAttribute('name');

                // Mendapatkan nilai jawaban dari value gambar yang diklik
                var selectedValue = label.getAttribute('value');

                // Memisahkan berdasarkan nama survei dan menyimpan nilai jawaban ke variabel yang sesuai
                switch (surveyName) {
                    case 'survei_interaksi':
                        surveyResponse1 = selectedValue;
                        break;
                    case 'survei_cepat':
                        surveyResponse2 = selectedValue;
                        break;
                    case 'survei_tepat':
                        surveyResponse3 = selectedValue;
                        break;
                    case 'survei_masalah':
                        surveyResponse4 = selectedValue;
                        break;
                    case 'survei_kesalahan':
                        surveyResponse5 = selectedValue;
                        break;
                    default:
                        console.log('Nama survei tidak dikenali');
                }
            });
        });
    });

    // Menangani klik pada tombol submit
    $('#submit').click(function(event) {
        event.preventDefault();

        // Pisahkan nilai jawaban ke dalam 5 variabel terpisah
        console.log('Jawaban Survey 1:', surveyResponse1);
        console.log('Jawaban Survey 2:', surveyResponse2);
        console.log('Jawaban Survey 3:', surveyResponse3);
        console.log('Jawaban Survey 4:', surveyResponse4);
        console.log('Jawaban Survey 5:', surveyResponse5);

        // Menggunakan AJAX untuk mengirim data ke updateSurvei.php
        $.ajax({
            type: 'POST',
            url: 'updateSurvei.php',
            contentType: 'application/json',
            data: JSON.stringify({
                survei_interaksi: surveyResponse1,
                survei_cepat: surveyResponse2,
                survei_tepat: surveyResponse3,
                survei_masalah: surveyResponse4,
                survei_kesalahan: surveyResponse5
            }),
            success: function(response) {
                console.log(response);

                // Mengarahkan pengguna ke halaman sukses
                window.location.href = 'trimsSurvei.php';

                // Setelah 5 detik, kembali ke halaman semula
                setTimeout(function() {
                    window.location.href = 'survei_users.php';
                }, 5000); // Menunggu 5 detik sebelum melakukan pengalihan kembali
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Tangani kesalahan jika ada
                alert('Gagal mengirim data survei');
            }
        });

    });
    </script>

    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!-- <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->

</body>

</html>