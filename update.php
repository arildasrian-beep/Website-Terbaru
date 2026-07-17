<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user_id = $_SESSION['user_id'];

if ($id <= 0) {
    echo "ID tidak valid.";
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM task WHERE id = $id AND user_id = $user_id");
$task = mysqli_fetch_assoc($result);

if (!$task) {
    echo "Tugas tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_task = mysqli_real_escape_string($conn, $_POST['title']);
    if (!empty($new_task)) {
        mysqli_query($conn, "UPDATE task SET title = '$new_task' WHERE id = $id AND user_id = $user_id");
        header("Location: index.php");
        exit;
    } else {
        $error = "Tugas tidak boleh kosong!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tugas</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap');

        body {
            background-image: url('hayato.jpg');
            font-family: 'Poppins', sans-serif;
            background-color: #f2f5f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 450px;
            margin: 40px auto;
            padding: 20px;
            background: hsla(221, 53.8%, 40.8%, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            border-radius: 16px;
            color: #ffffff;
        }

        h2 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            background-color: white;
            color: black;
        }

        button {
            padding: 10px 16px;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #33adff;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h2>Edit Tugas</h2>

        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="post">
            <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
            <button type="submit">Update</button>
        </form>
           
        <a class="back-link" href="index.php">← Kembali ke daftar tugas</a>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
