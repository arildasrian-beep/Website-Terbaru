<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data user berdasarkan username
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Cek password input dengan hash di database
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - To-Do List</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        html, body {
            height: 100%;
            width: 100%;
        }

    body {
  background-image: url('OIP.jpg');
  background-size: contain;
  background-position: center bottom;
  background-repeat: no-repeat;
  min-height: 100vh;
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: flex-start; /* dari flex-end jadi flex-start */
  padding-top: 80px; /* geser login ke atas */
}

.login-container {
  background-color: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(4px);
  color: white;
   border color: 1px solid rgba(255, 255, 255, 0.2);
  padding: 12px 16px;
  border-radius: 10px;
  width: 180px;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
  text-align: center;
  font-size: 14px;

  /* Tambahan ini untuk naikkan posisi */
  position: relative;
  top: -30px; /* naikkan 30px, bisa sesuaikan */
}



        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 8px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .login-container a {
            color: #4dabf7;
            text-decoration: none;
            font-weight: bold;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }

        .login-container p {
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
        <img src="mobil.jng" alt="">
    <form action="" method="POST">
        <h2>Login</h2><br>
        <?php if (isset($error)) echo "<div class='error-message'>$error</div>"; ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
        <p>Belum punya akun? <a href="register.php"><br>Register</a></p>
    </form>
</div>

</body>
</html>
