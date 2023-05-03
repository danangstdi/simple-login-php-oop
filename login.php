<?php

session_start();

require_once 'db.php';

$db = new Database();

//jika button dengan name "masuk" ditekan atau sudah ter-isset
if( isset($_POST["masuk"]) ) {
  
  //mengambil data yang di inputkan pada kolom username dan password
  $username = $_POST["username"];
  $password = $_POST["password"];

  //proses pemcocokan username yang ada didalam database dengan username yang di inputkan user pada laman login
  $result = mysqli_query($db->con, "SELECT * FROM tugastb WHERE username = '$username'");
  
  //jika $result diatas benar/true (true dilambangkan dengan angka 1)(bisa dengan menuliskan '> 0' atau '=== 1')
  if( mysqli_num_rows($result) > 0 ) {
    $row = mysqli_fetch_assoc($result);
    
    //function password_verify() fungsi dari php untuk mengverifikasi password yang diinputkan user dengan password yang berada didalam database
    if( password_verify($password, $row["password"]) ) {

      //mengaktifkan session 'login'
      $_SESSION["login"] = true;

      //$id berisi 'id' dari dalam database
      $id = $row['id'];
      echo "<script>
              alert('Anda berhasil masuk');
              document.location.href = 'index.php?id=$id';
            </script>";
      exit;
    }
  }
  //pencocokan username gagal(username yang di inputkan user tidak ada didalam database)
 $error = false ;
}
//jika $error diatas aktif, maka alert gagal login akan muncul
if( isset($error) ) {
  echo "<script>
          alert('Username atau Password yang anda masukkan salah');
        </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mini Project - Sign In</title>
  <link rel="stylesheet" href="style/style.css">
</head>
<body>

  <form action="" method="post">

    <div class="container-login">

      <h1>Sign In</h1>

      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>

      <button type="submit" name="masuk">Masuk</button>
      
      <div class="form-regist">
        <label>Belum punya akun ?</label>
        <!-- untuk berpindah ke halaman registrasi -->
        <a href="regist.php">Buat Akun</a>
      </div>

    </div>

  </form>

</body>
</html>