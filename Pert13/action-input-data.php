<?php
include "koneksi.php";

if (isset($_POST['Submit']) && $_POST['Submit'] == "Submit") {

    $id_mahasiswa = $_POST['id_mahasiswa'];
    $nama         = $_POST['nama'];
    $jurusan      = $_POST['jurusan'];
    $alamat       = $_POST['alamat'];
    $telepon      = $_POST['telepon'];

    // validasi data kosong
    if (empty($id_mahasiswa) || empty($nama) || empty($alamat) || empty($telepon)) {
        echo "<script>
                alert('Data Harap Dilengkapi!');
                document.location='forminput.php';
              </script>";
        exit;
    }

    // cek NIM di database
    $stmt = mysqli_prepare($Open, "SELECT id_mahasiswa FROM mahasiswa WHERE id_mahasiswa = ?");
    mysqli_stmt_bind_param($stmt, "s", $id_mahasiswa);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $cek = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);

    if ($cek > 0) {
        echo "<script>
                alert('NIM sudah dipakai!, silahkan ganti NIM yang lain');
                document.location='forminput.php';
              </script>";
        exit;
    }

    // masukkan data ke tabel
    $stmt = mysqli_prepare($Open, "INSERT INTO mahasiswa (id_mahasiswa, nama, jurusan, alamat, telepon) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $id_mahasiswa, $nama, $jurusan, $alamat, $telepon);
    $berhasil = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($berhasil) {
        echo "<script>
                alert('Input Data Mahasiswa Berhasil');
                document.location='forminput.php';
              </script>";
    } else {
        echo "Input Data Mahasiswa Gagal!, Silahkan diulangi!";
    }

    mysqli_close($Open);
}
?>