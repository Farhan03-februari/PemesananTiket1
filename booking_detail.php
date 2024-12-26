<?php
session_start();
include 'service/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$name = isset($_SESSION['username']) ? $_SESSION['username'] : 'Tidak Diketahui';
$alamat = isset($_SESSION['alamat']) ? $_SESSION['alamat'] : 'Tidak Diketahui';
$nomor_handphone = isset($_SESSION['nomor_handphone']) ? $_SESSION['nomor_handphone'] : 'Tidak Diketahui';


// Ambil detail pemesanan tiket
$sql = "SELECT bookings.*, movies.title, showtimes.showtime, showtimes.ticket_price 
        FROM bookings 
        INNER JOIN movies ON bookings.movie_id = movies.id 
        INNER JOIN showtimes ON bookings.showtime_id = showtimes.id 
        WHERE bookings.id = $id";
$result = $conn->query($sql);
$booking = $result->fetch_assoc();

if (!$booking) {
    die("Tiket tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detail Tiket</title>
    <link rel="stylesheet" href="css/booking-detail.css?v=<?php echo time(); ?>">
</head>
<body>
    <header>
    <div class="logo">
            <img src="images/logo.png" alt="">
            <h1>Spot Cinema</h1>
        </div>
    </header>
    <main>
        <h1>Detail Tiket</h1>
        <div class="ticket-card">
            <p><strong class="label">Nama Pemesan:</strong><span class="value"><?php echo htmlspecialchars($name); ?></span></p>
            <p><strong class="label">Alamat:</strong><span class="value"><?php echo htmlspecialchars($alamat); ?></span></p>
            <p><strong class="label">Nomor Handphone:</strong><span class="value"><?php echo htmlspecialchars($nomor_handphone); ?></span></p>
            <p><strong class="label">Judul Film:</strong><span class="value"><?php echo $booking['title']; ?></span></p>
            <p><strong class="label">Waktu Tayang:</strong><span class="value"><?php echo date('d M Y H:i', strtotime($booking['showtime'])); ?></span> </p>
            <p><strong class="label">Jumlah Kursi:</strong><span class="value"><?php echo $booking['seats']; ?></span></p>
            <p><strong class="label">Harga Tiket per Kursi:</strong><span class="value">Rp <?php echo number_format($booking['ticket_price'], 0, ',', '.'); ?></span></p>
            <p><strong class="label">Total Harga:</strong><span class="value">Rp <?php echo number_format($booking['total_price'], 0, ',', '.'); ?></span></p>
        </div>
        <div class="actions">
            <a href="payment.php?id=<?php echo $booking['id']; ?>" class="btn">Lanjutkan ke Pembayaran</a>
        </div>
    </main>
</body>
</html>
