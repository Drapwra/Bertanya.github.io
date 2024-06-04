<?php

session_start();
include 'functions.php';


$email = "guru@gmail.com";
$password_sebelum = "guru";
$password = password_hash($password_sebelum, PASSWORD_DEFAULT);

mysqli_query($conn, "UPDATE user SET email = '$email', password = '$password' WHERE id_user = 1");