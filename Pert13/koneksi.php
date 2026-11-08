<?php
$host = "localhost";
$user = "root";
$pass = "123456";                 // default Laragon: kosong
$db   = "mahasiswa"; // ganti sesuai nama database yang kamu buat di phpMyAdmin

$Open = mysqli_connect($host, $user, $pass, $db);

if (!$Open) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>