<?php
// pertemuan 2 - PHP Dasar
// Sintaks PHP_AMQP_MAX_CHANNELS

// Standar Output
// echo, print
// print_r (mencetak isi Array)
// var_dump (melihat isi dari var)

// echo "Sulaiman";

// Penulisan sintaks PHP
// 1. PHP di dalam HTML
// 2. HTML di dalam PHP

// Variabel dan Tipe Data
// Variabel
// Tidak boleh diawali dengan angka, tapi boleh mengandung angka

$nama = "Sulaiman";

// Operator
// Aritmatika 
// + - * / %
$x = 10;
$y = 20;

// Penggabung String
// .

$nama_depan = "Sulaiman";
$nama_belakang = "Mohammad";

// Assigment
// =, +=. -=, *=, /=, %=, .=
$i = 1;
$i -= 5;

$nama = "Sulaiman";
$nama .= " ";
$nama .= "Mohammad";

// Perbandingan
// <, >, <=, >= , ==, !=
var_dump(1=="1");

// Identitas
// ===, !==
var_dump(1!=="1");

// Logika
// &&, ||, ! 
$j = 10;

var_dump($j < 20 && $j%2 == 0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar PHP</title>
</head>
<body>
    <h1>Halo, Selamat Datang <?php echo "Sulaiman";?></h1>
    <?php echo "<h1> Halo, Selamat Datang Sulaiman 2</h1>"; ?>
    <h1>Halo, Selamat Datang <?php echo $nama;?></h1>

    <?php echo "x * y = ", $x * $y; ?>
    <br>
    <?php echo $nama_depan . " " . $nama_belakang; ?>
    <br>
    <?php echo  $i; ?>
    <br>
    <?php echo  $nama; ?>

</body>
</html>
