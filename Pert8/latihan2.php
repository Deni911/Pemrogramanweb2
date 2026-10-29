<html>
<head>
    <title>Contoh Penggunaan UDF</title>
</head>
<body>

<!-- Menentukan Form Input -->
<form method="post">
    Masukkan Bilangan Pertama : <br>
    <input type="text" name="A" size="10"> <br>

    Masukkan Bilangan Kedua : <br>
    <input type="text" name="B" size="10"> <br>

    <input type="submit" value="hitung">
</form>

<?php
// Membandingkan 2 buah bilangan yang diinput
$a = $_POST["A"] ?? null;
$b = $_POST["B"] ?? null;

function jumlah($A, $B)
{
    $jumlahbil = $A + $B;
    return $jumlahbil;
}

function kurang($A, $B)
{
    $kurangbil = $A - $B;
    return $kurangbil;
}

function kali($A, $B)
{
    $kalibil = $A * $B;
    return $kalibil;
}

function bagi($A, $B)
{
    return $A / $B;
}

if (isset($_POST["A"], $_POST["B"]) && is_numeric($a) && is_numeric($b)) {

    $A = (float) $a;
    $B = (float) $b;

    echo "<br>";
    echo "Bilangan Pertama : ";
    echo $A;
    echo "<br>";

    echo "Bilangan Kedua : ";
    echo $B;
    echo "<br><br>";

    echo "Hasil Penjumlahan 2 buah bilangan ";
    echo "<br>";
    $jumlahbil = jumlah($A, $B);
    printf("Penjumlahan antara : %g + %g = %g", $A, $B, $jumlahbil);

    echo "<br><br>";
    echo "Hasil Pengurangan 2 buah bilangan ";
    echo "<br>";
    $kurangbil = kurang($A, $B);
    printf("Pengurangan antara : %g - %g = %g", $A, $B, $kurangbil);

    echo "<br><br>";
    echo "Hasil Perkalian 2 buah bilangan ";
    echo "<br>";
    $kalibil = kali($A, $B);
    printf("Perkalian antara : %g * %g = %g", $A, $B, $kalibil);

    echo "<br><br>";
    echo "Hasil Pembagian 2 buah bilangan ";
    echo "<br>";

    if ($B != 0) {
        $bagibil = bagi($A, $B);
        printf("Pembagian antara : %g / %g = %g", $A, $B, $bagibil);
    } else {
        echo "Pembagian tidak dapat dilakukan karena bilangan kedua adalah 0.";
    }

    echo "<br><br>";
}
?>

</body>
</html>