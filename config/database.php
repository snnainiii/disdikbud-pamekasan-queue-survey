<?php
// deklarasi parameter koneksi database
$host     = "localhost";              // server database, default “localhost” atau “127.0.0.1”
$username = "root";                   // username database, default “root”
$password = "";                       // password database, default kosong
$database = "antrian";             // memilih database yang akan digunakan

// buat koneksi database
$conn = mysqli_connect($host, $username, $password, $database);
// cek koneksi
// jika koneksi gagal 
if (!$conn) {
  // tampilkan pesan gagal koneksi
  die('Koneksi Database Gagal : ' . mysqli_connect_error());
}