<?php

session_start();

//penghubung dengan file db.php
require_once 'db.php';

//membuat variabel db dengan isi class Database dari file db.php
$db = new Database();

//jika tombol dengan name "daftar" ditekan/ter-isset
if(isset($_POST["daftar"])) {
  //jika function regist() bernilai true '1'
  if($db->registrasi($_POST) === 1) {
    //code yang dieksekusi jika pengkondisian terpenuhi
    echo "<script>
            alert('Anda berhasil mendaftar');
            document.location.href = 'login.php';
          </script>";
  }else {
    //mysqli_error muncul jika pengkondisian tidak terpenuhi
    echo mysqli_error($db->con);
  }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mini Project - Sign Up</title>
  <link rel="stylesheet" href="style/style.css">
</head>
<body>

  <form action="" method="post">

    <div class="container-regist">

      <h1>Sign Up</h1>
      
      <!-- name digunakan untuk pengambilan data yang akan diterima pada file db.php function registrasi() -->
      <input type="text" name="nama-lengkap" placeholder="nama lengkap" required>
      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>
      <input type="password" name="password-confirm" placeholder="password confirm" required>
      
      <!-- tombol dengan name "daftar" -->
      <button type="submit" name="daftar">Daftar</button>
      
      <div class="form-regist">
        <label>Belum punya akun ?</label>
        <!-- untuk berpindah ke halaman login -->
        <a href="login.php">Buat Akun</a>
      </div>

    </div>

  </form>

</body>
</html>