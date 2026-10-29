
<?php
// Host name atau alamat server
$servername = "localhost";

// Username dan password database
$dbusername = "root";
$dbpassword = "123456";

// Menghubungkan ke MySQL
$link = mysqli_connect($servername, $dbusername, $dbpassword);

if (!$link) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    echo "OK, koneksi berhasil";
}
?>
