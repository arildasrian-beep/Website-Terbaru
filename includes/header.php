<?php
// Cek apakah session sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ambil username dari session jika tersedia
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1 style="text-align:center;">To-Do List</h1>
        <?php if (!empty($username)): ?>
            <div style="text-align: center; margin-top: 20px; font-size: 18px;">
                Halo, <strong><?php echo htmlspecialchars($username); ?></strong> 👋<br>
                Semangat menyelesaikan tugasmu hari ini! 💪
            </div>
        <?php endif; ?>
    </header>
    <hr>
