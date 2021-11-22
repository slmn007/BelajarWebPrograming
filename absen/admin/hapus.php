<?php 

session_start();

if(!isset($_SESSION["login"])) {
	header("location: login_admin.php");
	exit;
}

$id = $_GET["id_mhs"];

$url="http://localhost:8080/rest_api/data.php?id_mhs=$id";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($curl);
curl_close($curl);
echo $response;
if ($response['Deleted_data'] == true) {  
    echo "	
    <script>
        alert('Data Berhasil Dihapus');
        document.location.href = 'index_admin.php';
    </script>
    ";
} else {
    echo "	
    <script>
        alert('Data Gagal Dihapus');
        document.location.href = 'index_admin.php';
    </script>
    ";
}

?>