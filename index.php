<?php

session_start();

//jika session belum aktif/belum ter-isset tapi user memaksa masuk ke index.php melalui edit url, alert akan muncul dan user dikembalikan ke menu login.php
if(!isset($_SESSION['login'])) {
  echo "<script>
          alert('Anda harus login terlebih dahulu');
          document.location.href = 'login.php';
        </script>";
  exit;
}

require_once 'db.php';

$db = new Database();

//mengambil value id pada url menggunakan method get
$id = $_GET["id"];

//memilih data dari tabel tugastb yang dimana id database dan id di url bernilai sama
$row = $db->query("SELECT * FROM tugastb WHERE id = $id")[0];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mini Project - Home</title>
  <link rel="stylesheet" href="style/index.css">
</head>
<body>

  <div class="container">

    <div class="welcome">Selamat Datang</div>
    <h1><?php echo $row['nama'] //pemanggilan data 'nama' dari database ?></h1>
    
    <!-- masuk ke logout.php dan otomatis menjalankan session_destroy -->
    <a href="logout.php">
      <button>Keluar</button>
    </a>

  </div>

</body>
</html>