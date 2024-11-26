<?php
// db_connect.php

// Koneksi ke database (gunakan prosedural mysqli)
$host = 'localhost';
$dbname = 'pemesanan_tiket_pesawat';
$username = 'root';
$password = '';

// Koneksi ke database
$db = mysqli_connect($host, $username, $password, $dbname);

// Mengecek koneksi
if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}



// Tutup koneksi setelah selesai
