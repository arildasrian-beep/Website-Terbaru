<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "todo-list";
$port = 3306;

$conn = mysqli_connect($host, $user, $pass, $db, $port,);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>		