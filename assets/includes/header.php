<?php
// Cek apakah session sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <img src="Toraja.png" alt="">
    <header>
        <h1>To-Do List</h1>
        <?php if (isset($_SESSION['username'])): ?>
            <p>Halo, <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">Logout</a></p>
        <?php endif; ?>
    </header>
    <hr>
