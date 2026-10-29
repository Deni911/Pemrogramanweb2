
<?php
$conn = mysqli_connect("localhost", "root", "123456");
if (!$conn) {
    die("Could not connect: " . mysqli_connect_error());
}

mysqli_select_db($conn, "lat_dbase");
mysqli_query($conn, "UPDATE tbl_mhs SET Age = '36'
WHERE FirstName = 'Karina' AND LastName = 'Suwandi'");
mysqli_close($conn);
echo "Data mahasiswa berhasil diperbarui";
?>
