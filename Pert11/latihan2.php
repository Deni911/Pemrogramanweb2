
<?php
$conn = mysqli_connect("localhost", "root", "123456");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$dbname = "lat_dbase";

$cek = mysqli_query($conn, "CREATE DATABASE $dbname");

if ($cek) {
    echo "Database $dbname berhasil dibuat";
} else {
    echo "Database gagal dibuat: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
