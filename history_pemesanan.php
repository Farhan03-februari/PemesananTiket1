<?php
session_start();
include 'service/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
// $alamat = isset($_SESSION['alamat']) ? $_SESSION['alamat'] : 'Tidak Diketahui';
// $nomor_handphone = isset($_SESSION['nomor_handphone']) ? $_SESSION['nomor_handphone'] : 'Tidak Diketahui';

// Ambil riwayat pemesanan
$sql = "SELECT b.id, b.total_price, b.seats, b.payment_status, m.title, s.showtime
        FROM bookings b
        JOIN movies m ON b.movie_id = m.id
        JOIN showtimes s ON b.showtime_id = s.id
        WHERE b.user_id = $user_id
        ORDER BY s.showtime ASC";
$result = $conn->query($sql);
$bookings = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Riwayat Pemesanan</title>
    <link rel="stylesheet" href="css/history_pemesanan.css?V=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
    <div class="back">
            <a href="berandaa.php?movie_id=<?php echo $movie['id']; ?>" class="button">
                <i class='bx bx-arrow-back'></i> Back
            </a>
        </div>
        <div class="logo">
            <img src="images/logo.png" alt="">
            <h1>Spot Cinema</h1>
        </div>
    </header>
    <main>
        <h1>Riwayat Pemesanan</h1>
        <?php if (empty($bookings)) : ?>
            <p>Belum ada pemesanan.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Nama Pemesan</th>
                        <th>Alamat</th>
                        <th>Nomor Handphone</th>
                        <th>Film</th>
                        <th>Waktu Tayang</th>
                        <th>Jumlah Kursi</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking) : ?>
                        <tr>
                            <td><?php echo $_SESSION['username']; ?></td>
                            <td><?php echo $_SESSION['alamat']; ?></td>
                            <td><?php echo $_SESSION['nomor_handphone']; ?></td>
                            <td><?php echo $booking['title']; ?></td>
                            <td><?php echo date('d M Y H:i', strtotime($booking['showtime'])); ?></td>
                            <td><?php echo $booking['seats']; ?></td>
                            <td>Rp <?php echo number_format($booking['total_price'], 0, ',', '.'); ?></td>
                            <td><?php echo $booking['payment_status']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>
