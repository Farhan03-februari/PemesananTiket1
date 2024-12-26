<?php
session_start();
include 'service/db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bioskop-21</title>
    <link rel="stylesheet" href="css/berandaa.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>Spot Cinema</h1>
            <p>Pesan Tiket Anda Sekarang Juga, sebelum Habis...</p>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="berandaa.php">Home</a></li>
                <li><a href="daftar_film.php">Daftar Film</a></li>
                <li><a href="history_pemesanan.php">History Pemesanan</a></li>
            </ul>
            <div class="sesion-info">
                <div class="sesion-name">
                    <i class='bx bx-user'></i>
                    <p><?php echo $_SESSION['username']; ?></p>
                </div>
                <div class="logout">
                    <form action="logout.php" method="POST" class="login-email">
                        <button type="submit" class="btn">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>
