<?php

class Database {
  public $con;

  public function __construct(
    $server = 'localhost',
    $username = 'root',
    $password = '',
    $db = 'tugasdb'
  ) {
    //pengkoneksian ke Database (tugasdb)
    $this->con = mysqli_connect($server, $username, $password, $db);

    //cek apakah berhasil terkoneksi ke database atau tidak
    if(!$this->con) {
      die('Pengkoneksian ke database gagal :' . mysqli_connect_error());
    }
  }

  public function query($sql) {

    $result = mysqli_query($this->con, $sql);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result))
    {
      $rows[] = $row;
    }
    return $rows;
  }

  public function registrasi($sql) {
    $name = stripcslashes($sql["nama-lengkap"]);
    $username = stripcslashes($sql["username"]);
    $password = mysqli_real_escape_string($this->con, $sql["password"]);
    $passwordConfirm = mysqli_real_escape_string($this->con, $sql["password-confirm"]);

    //fitur jika username yang di inputkan user sudah terdaftar/sudah ada didalam database maka registrasi false/gagal
    $query = "SELECT username FROM tugastb WHERE username = '$username'";

    $result = mysqli_query($this->con, $query);
    if( mysqli_fetch_assoc($result)) {
      echo "<script>
              alert('Username sudah terpakai!');
            </script>";
      return false;
    }

    //fitur jika password dan konfirmasi password yang dimasukkan user tidak sama maka registrasi false/gagal
    // '!' dibaca 'not'(tidak/bukan)
    if( $password !== $passwordConfirm ) {
      echo "<script>
              alert('Password & Konfirmasi Password yang anda masukkan tidak sama');
            </script>";
      return false;
    }
  
    //fitur untuk meng-enkripsi password, dengan kata lain password otomatis menjadi karakter random saat masuk kedalam database
    $hash = password_hash($password, PASSWORD_DEFAULT);

    //jika lolos dari semua fitur/pengkondisian diatas maka data yang di inputkan user akan masuk ke database
    mysqli_query($this->con, "INSERT INTO tugastb VALUES('', '$name', '$username', '$hash')");

    return mysqli_affected_rows($this->con);
  }
}