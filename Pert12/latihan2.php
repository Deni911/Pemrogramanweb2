<?php
$conn = mysqli_connect("localhost", "root", "123456");
if (!$conn) {
    die("Could not connect: " . mysqli_connect_error());
}

mysqli_select_db($conn, "lat_dbase");
$sql = "DELETE FROM tbl_mhs WHERE LastName = 'Prabowo'";
if (mysqli_query($conn, $sql)) {
    echo "Data mahasiswa Prabowo berhasil dihapus";
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
