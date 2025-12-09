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
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;

}

.kotak-sukses {

    background-color: #ffffff;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 4px;
    padding: 20px;
}

.judul-rating h1 {
    /* padding: 10px; */
    text-align: center;
    font-size: 40px;
}

/* NOTIFIKASI */

.notification {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;
    background: #ffe691;
    border: 1px solid #f6db7b;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    width: 800px;
    height: 130px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-size: 25px;
    opacity: 0;
    /* Mulai dengan keadaan tersembunyi */
    animation: fadeOut 3s linear forwards;
}

@keyframes fadeOut {
    0% {
        opacity: 1;
        transform: translate(-50%, -50%);
        background-color: #ffe691;
        /* Warna awal */
    }

    90% {
        opacity: 1;
        transform: translate(-50%, -60%);
        /* Pindahkan ke atas */
        background-color: #fff4d0;
        /* Warna memudar */
    }

    100% {
        opacity: 0;
        transform: translate(-50%, -70%);
        /* Pindahkan ke atas lebih jauh dan hilangkan */
        background-color: #fffcf0;
        ;
        /* Warna memudar */
    }
}
</style>

<body>
    <div class="kotak-sukses notification">
        <div class="judul-rating">
            <h1>TERIMA KASIH TELAH MEMBERIKAN SURVEI</h1>
            <!-- <p>BERI RATING BAGAIMANA PELAYANAN INI</p> -->
        </div>
    </div>

    <!-- Letakkan skrip JavaScript di sini -->
    <script>
    setTimeout(function() {
        window.location.href = 'survei_users.php';
    }, 4000); // Kembali ke halaman survei setelah 5 detik
    </script>
</body>

</html>