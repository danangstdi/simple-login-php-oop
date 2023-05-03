<?php

//setiap halaman yang menggunakan method session harus dimulai dengan session_start()
session_start();

//session_destroy untuk menghentikan session
session_destroy();

//setelah session berhanti user otomatis diarahkan ke menu login.php
header("Location: login.php");