<?php 

session_start();

if(!isset($_SESSION["login"])) {
	header("location: login.php");
	exit;
}

// ambil data dari rest_api
$nim = $_SESSION["nim"];
$data = file_get_contents("http://localhost:8080/rest_api/data.php?nim_mhs=$nim");
$data = json_decode($data, true);
$data = $data["result"];

$matkul = file_get_contents("http://localhost:8080/rest_api/matakuliah.php");
$matkul = json_decode($matkul, true);
$matkul = $matkul["result"];

// cek apakah tombol sudah dipencet
if ( isset($_POST["submit"])) {
    $kode_matkul = $_POST["kode_matkul"];
    $ket_absen = $_POST["ket_absen"];

    if ($kode_matkul == "" && $ket_absen == "") {
        echo "	
        <script>
            alert('Matakuliah Dan Keterangan Absen Belum Diisi');
            document.location.href = 'index.php';
        </script>
        ";
    } else if ($ket_absen == "") {
        echo "	
        <script>
            alert('Keterangan Absen Belum Diisi');
            document.location.href = 'index.php';
        </script>
        ";
    } else if ($kode_matkul == "") {
        echo "	
        <script>
            alert('Matakuliah Belum Diisi');
            document.location.href = 'index.php';
        </script>
        ";
    } else {
        $url="http://localhost:8080/rest_api/absen.php?nim_mhs=$nim&kode_matkul=$kode_matkul&ket_absen=$ket_absen";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        echo "	
        <script>
            alert('Data Berhasil Dikirim');
            document.location.href = 'index.php';
        </script>
        "; 
        curl_close($curl);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title> <?= $data["nim_mhs"] ?> - <?= $data["nama_mhs"] ?></title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><source src="assets/mp4/bg.mp4" type="video/mp4" /></video>
        <div class="masthead">
            <div class="masthead-content text-white">
                <div class="container-fluid px-4 px-lg-0">
                    <h1 class="fst-italic lh-1 mb-4">NIM: <?= $data["nim_mhs"] ?></h1>
                    <p class="mb-5"> 
                        Nama = <?= $data["nama_mhs"] ?> <br>
                        Kode Prodi = 
                        <?php
                        if ($data["kode_prodi"] == "T1") {
                            echo "Teknik Informatika";
                        } else if ($data["kode_prodi"] == "T2") {
                            echo "Sistem Informasi";
                        } else if ($data["kode_prodi"] == "T3") {
                            echo  "Teknik Elektro";
                        } else if ($data["kode_prodi"] == "T4") {
                            echo "Teknik Industri";
                        }
                        ?> 
                        <br>
                        Jenis Kelamin = <?=$data["jenis_kelamin"] == "1" ? "Laki-Laki" :  "Perempuan";?> <br>
                        Alamat = <?= $data["alamat_mhs"] ?> <br>
                        Agama = <?= $data["agama_mhs"] ?>
                    </p>
                    <form id="contactForm" data-sb-form-api-token="API_TOKEN" action="" method="POST">
                        <div class="form-group">
                            <select class="form-control" name="kode_matkul">
                                <option value="" aria-label="Enter Keterangan...">--Pilih Matkul--</option>
                                <?php foreach($matkul as $row) :?>
                                    <option value="<?= $row['kode_matkul'] ?>"><?= $row['nama_matkul'] ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <p></p>
                        <div class="row input-group-newsletter">
                            <div class="col"><input name="ket_absen" class="form-control" type="text" placeholder="Enter Keterangan..." aria-label="Enter Keterangan..." data-sb-validations="required" /></div>
                            <div class="col-auto"><button class="btn btn-primary" type="submit" name="submit">Kirim!</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="social-icons">
            <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                <a class="btn btn-dark m-3" href="logout.php">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
