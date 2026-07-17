<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $task = $_POST['task'];

    if ($user_id && $task) {
        $query = "INSERT INTO task (user_id, title) VALUES ('$user_id', '$task')";
        mysqli_query($conn, $query);
        header("Location: index.php");
        exit;
    } else {
        $error = "Gagal menambahkan tugas. Session user tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tugas</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <h2>Tambah Tugas Baru</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="task" placeholder="Tugas baru..." required>
        <button type="submit">Simpan</button>
    </form>
    <a href="index.php">Kembali</a>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
