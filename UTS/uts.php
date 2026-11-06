<?php
// KONEKSI DATABASE
$conn = mysqli_connect("localhost", "root", "123456");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// MEMBUAT DATABASE
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS utspemrograman2");
mysqli_select_db($conn, "utspemrograman2");

// MEMBUAT TABEL
$sql = "CREATE TABLE IF NOT EXISTS pendaftaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tgl_input DATE,
    kode VARCHAR(20),
    nama VARCHAR(100),
    jk VARCHAR(20),
    asal_sekolah VARCHAR(100),
    pekerjaan_ortu VARCHAR(100),
    tempat_lahir VARCHAR(100),
    tgl_lahir DATE,
    mat FLOAT,
    bing FLOAT,
    umum FLOAT,
    rata FLOAT,
    tempat_tes VARCHAR(50),
    keterangan VARCHAR(30)
)";

mysqli_query($conn, $sql);

$pesan = "";

if (isset($_POST['simpan'])) {

    $tgl_input = $_POST['tgl_input'];
    $kode = strtoupper($_POST['kode']);
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $pekerjaan_ortu = $_POST['pekerjaan_ortu'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];

    $mat = $_POST['mat'];
    $bing = $_POST['bing'];
    $umum = $_POST['umum'];

    // Hitung rata-rata
    $rata = ($mat + $bing + $umum) / 3;

    // Menentukan keterangan
    if ($rata >= 70) {
        $keterangan = "Lulus";
    } elseif ($rata >= 60) {
        $keterangan = "Cadangan";
    } else {
        $keterangan = "Tidak Lulus";
    }

    // Menentukan tempat tes
    $kode_awal = substr($kode, 0, 1);

    if ($kode_awal == "A") {
        $tempat_tes = "Gedung A";
    } elseif ($kode_awal == "B") {
        $tempat_tes = "Gedung B";
    } elseif ($kode_awal == "V") {
        $tempat_tes = "Viktor";
    } else {
        $tempat_tes = "Tidak Diketahui";
    }

    // Simpan ke database
    $stmt = mysqli_prepare($conn, "INSERT INTO pendaftaran
        (tgl_input, kode, nama, jk, asal_sekolah,
        pekerjaan_ortu, tempat_lahir, tgl_lahir,
        mat, bing, umum, rata, tempat_tes, keterangan)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssssddddss",
        $tgl_input,
        $kode,
        $nama,
        $jk,
        $asal_sekolah,
        $pekerjaan_ortu,
        $tempat_lahir,
        $tgl_lahir,
        $mat,
        $bing,
        $umum,
        $rata,
        $tempat_tes,
        $keterangan
    );

    if (mysqli_stmt_execute($stmt)) {
        $pesan = "Data berhasil disimpan ke database!";
    } else {
        $pesan = "Gagal menyimpan data: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UTS PHP - Pendaftaran Mahasiswa</title>

<style>
body{
    font-family: Arial, Helvetica, sans-serif;
    margin:30px;
    background:#f4f4f4;
}

.container{
    width:900px;
    margin:auto;
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.2);
}

h2,h3{
    text-align:center;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table,th,td{
    border:1px solid black;
}

th,td{
    padding:8px;
    text-align:center;
}

input[type=text],
input[type=number],
input[type=date]{
    width:100%;
    padding:8px;
    margin-top:5px;
    margin-bottom:10px;
    box-sizing:border-box;
}

.btn{
    background:blue;
    color:white;
    border:none;
    padding:10px 20px;
    cursor:pointer;
}

.btn:hover{
    background:darkblue;
}

.info{
    margin-top:20px;
    padding:10px;
    background:#eef;
}
</style>

</head>
<body>

<div class="container">

<h2>FORM PENDAFTARAN MAHASISWA BARU</h2>

<form method="POST">

<label>Tanggal Input</label>
<input type="date" name="tgl_input" required>

<label>Kode Pendaftaran</label>
<input type="text" name="kode" placeholder="Contoh : A2" required>

<label>Nama Pendaftar</label>
<input type="text" name="nama" required>

<label>Jenis Kelamin</label><br>
<input type="radio" name="jk" value="Laki-Laki" required> Laki-Laki
<input type="radio" name="jk" value="Perempuan"> Perempuan
<br><br>

<label>Asal Sekolah</label>
<input type="text" name="asal_sekolah" required>

<label>Pekerjaan Orang Tua</label>
<input type="text" name="pekerjaan_ortu" required>

<label>Tempat Lahir</label>
<input type="text" name="tempat_lahir" required>

<label>Tanggal Lahir</label>
<input type="date" name="tgl_lahir" required>

<label>Matematika</label>
<input type="number" name="mat" required>

<label>Bahasa Inggris</label>
<input type="number" name="bing" required>

<label>Umum</label>
<input type="number" name="umum" required>

<button type="submit" name="simpan" class="btn">SIMPAN</button>

</form>

<?php
if ($pesan != "") {
    echo "<div class='info'><b>$pesan</b></div>";
}

// Ambil semua data
$query = mysqli_query($conn, "SELECT * FROM pendaftaran ORDER BY id DESC");

$jumlah_pendaftar = mysqli_num_rows($query);
$jumlah_lulus = 0;
$jumlah_cadangan = 0;
$jumlah_tidak_lulus = 0;

$data = [];

while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;

    if($row['keterangan']=="Lulus"){
        $jumlah_lulus++;
    }elseif($row['keterangan']=="Cadangan"){
        $jumlah_cadangan++;
    }else{
        $jumlah_tidak_lulus++;
    }
}
?>

<h3>Data Seluruh Pendaftar</h3>

<table>
<tr>
<th>Kode</th>
<th>Nama</th>
<th>JK</th>
<th>Tgl Lahir</th>
<th>Asal Sekolah</th>
<th>Pekerjaan Ortu</th>
<th>Tempat Tes</th>
<th>MAT</th>
<th>B. Inggris</th>
<th>Umum</th>
<th>Rata-rata</th>
<th>Keterangan</th>
</tr>

<?php
foreach($data as $row){
echo "<tr>
<td>{$row['kode']}</td>
<td>{$row['nama']}</td>
<td>{$row['jk']}</td>
<td>{$row['tempat_lahir']}, {$row['tgl_lahir']}</td>
<td>{$row['asal_sekolah']}</td>
<td>{$row['pekerjaan_ortu']}</td>
<td>{$row['tempat_tes']}</td>
<td>{$row['mat']}</td>
<td>{$row['bing']}</td>
<td>{$row['umum']}</td>
<td>".number_format($row['rata'],2)."</td>
<td>{$row['keterangan']}</td>
</tr>";
}
?>

</table>

<div class="info">
<h3>Rekap Data</h3>

<p>Jumlah Pendaftar : <b><?php echo $jumlah_pendaftar; ?></b></p>
<p>Jumlah Peserta Lulus : <b><?php echo $jumlah_lulus; ?></b></p>
<p>Jumlah Peserta Cadangan : <b><?php echo $jumlah_cadangan; ?></b></p>
<p>Jumlah Tidak Lulus : <b><?php echo $jumlah_tidak_lulus; ?></b></p>
</div>

<div class="info">
<h3>Keterangan</h3>

<p><b>Kode Tempat Tes:</b></p>

<ul>
<li>A = Gedung A</li>
<li>B = Gedung B</li>
<li>V = Viktor</li>
</ul>

<p><b>Hasil Seleksi:</b></p>

<ul>
<li>Rata-rata ≥ 70 = Lulus</li>
<li>Rata-rata 60–69 = Cadangan</li>
<li>Rata-rata < 60 = Tidak Lulus</li>
</ul>

</div>

</div>

</body>
</html>

<?php
mysqli_close($conn);
?>