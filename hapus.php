<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Hapus hanya jika tugas milik user yang login
mysqli_query($conn, "DELETE FROM task WHERE id = $id AND user_id = $user_id");

header("Location: index.php");
exit;
