<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

include 'koneksi.php';

$query = "SELECT * FROM task WHERE user_id='$user_id' ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <style>
      body {
            background-image: url('final.jpg');
            font-family: 'Poppins', sans-serif;
            background-color:hsla(273, 88.20%, 46.50%, 0.79);
            margin: 0;
            padding: 0;
        }

       .container {
    max-width: 450px; /* ukuran lebih kecil dari sebelumnya */
    margin: 40px auto;
    padding: 20px;

    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);

    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
    border-radius: 16px;
    color: #fff;
}


        h2 {
            text-align: center;
            color: #333;
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
        }

        button {
    padding: 10px 16px;
    background-color: #ff4fa3; /* pink cerah */
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); /* bayangan */
}

button:hover {
    background-color: #ff0080; /* lebih gelap saat hover */
    transform: scale(1.05);    /* sedikit membesar */
}

    .logout a {
    display: inline-block;
    padding: 8px 14px;
    background-color: #ff6b81; /* merah muda terang */
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    transition: background 0.3s ease;
}

.logout a:hover {
    background-color: #ff3b5c;
}

/* Untuk tombol Edit dan Hapus */
span a {
    display: inline-block;
    padding: 6px 12px;
    margin: 4px 4px 4px 0;
    font-size: 13px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    color: white;
    box-shadow: 0 3px 8px rgba(0,0,0,0.25);
    transition: all 0.2s ease-in-out;
}

/* Edit (biru) */
span a:first-child {
    background-color: #3498db;
}

/* Hapus (merah) */
span a:last-child {
    background-color: #e74c3c;
}

/* Hover effect */
span a:hover {
    transform: scale(1.05);
    opacity: 0.9;
}



    </style>
</head>
<body>

    <div class="container">
      

        <div class="container">
    <h1>To-Do List</h1>
    <!-- isinya tugas-tugas -->
</div>


        <div class="welcome">
            Halo, <?php echo htmlspecialchars($username); ?>! Semangat menyelesaikan tugas harianmu 💪
        </div>

        <h3>Daftar Tugas</h3>

        <div class="form-wrapper">
            <form action="tambah.php" method="POST">
                <input type="text" name="task" placeholder="Tambah tugas baru..." required>
                <button type="submit">Tambah</button>
            </form>
            <img src="" alt="">
        </div>
             <div class="logout">
            <a href="logout.php">Logout</a>
        </div>

        <ul>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <li>
                    <?php echo htmlspecialchars($row['title']); ?>
                    <span>
                        <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="hapus.php?id=<?php echo $row['id']; ?>">Hapus</a>
                    </span>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="footer">
        &copy; 2025 To-Do List App
    </div>

</body>
</html>
