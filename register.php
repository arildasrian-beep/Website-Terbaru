<?php
include 'koneksi.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Cek apakah username sudah dipakai
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Username sudah digunakan!";
    } else {
        // Enkripsi password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan ke database
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Gagal mendaftar: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - To-Do List</title>
    <style>
        body {
            background-color: #000;
            background-image: url('R.jpg');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center bottom;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(4px);
            color: white;
            padding: 20px;
            border-radius: 10px;
            width: 220px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.2);
        }

        input, button {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 6px;
            border: none;
            font-size: 14px;
        }

        button {
            background-color: #4dabf7;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #339af0;
        }

        .error-message {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
        }

        a {
            color: #4dabf7;
            font-size: 13px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <form method="POST">
        <h2>Register</h2>
        <?php if (!empty($error)) echo "<div class='error-message'>$error</div>"; ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </form>
</div>
</body>
</html>
