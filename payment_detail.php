<?php
session_start();
include 'service/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$booking_id = $_GET['id'];

$name = isset($_SESSION['username']) ? $_SESSION['username'] : 'Tidak Diketahui';
$alamat = isset($_SESSION['alamat']) ? $_SESSION['alamat'] : 'Tidak Diketahui';
$nomor_handphone = isset($_SESSION['nomor_handphone']) ? $_SESSION['nomor_handphone'] : 'Tidak Diketahui';

// Ambil detail pemesanan
$sql = "SELECT bookings.*, movies.title, showtimes.showtime 
        FROM bookings 
        INNER JOIN movies ON bookings.movie_id = movies.id 
        INNER JOIN showtimes ON bookings.showtime_id = showtimes.id 
        WHERE bookings.id = $booking_id";
$result = $conn->query($sql);
$booking = $result->fetch_assoc();

if (!$booking) {
    die("Pemesanan tidak ditemukan.");
}

if ($booking['payment_status'] !== 'completed') {
    die("Pembayaran belum selesai.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detail Pembayaran</title>
    <link rel="stylesheet" href="css/payment-detail.css?V=<?php echo time(); ?>">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="">
            <h1>Spot Cinema</h1>
        </div>
    </header>
    <main>
        <div class="detail-pembayaran">
            <h1>Detail Pembayaran</h1>
            <p><strong class="label">Nama Pemesan</strong><span class="value"><?php echo htmlspecialchars($name); ?></span></p>
            <p><strong class="label">Alamat:</strong><span class="value"><?php echo htmlspecialchars($alamat); ?></span></p>
            <p><strong class="label">Nomor Handphone:</strong><span class="value"><?php echo htmlspecialchars($nomor_handphone); ?></span></p>
            <p><strong class="label">Film:</strong> <span class="value"><?php echo $booking['title']; ?></span> </p>
            <p><strong class="label">Waktu Tayang</strong><span class="value"><?php echo date('d M Y H:i', strtotime($booking['showtime'])); ?></span> </p>
            <p><strong class="label">Jumlah Kursi</strong> <span class="value"><?php echo $booking['seats']; ?></span></p>
            <p><strong class="label">Total Harga</strong> <span class="value">Rp <?php echo number_format($booking['total_price'], 0, ',', '.'); ?></span> </p>
            <p><strong class="label">Status Pembayaran</strong><span class="value"> <?php echo ucfirst($booking['payment_status']); ?></span></p>
            <p>Terima kasih telah melakukan pembayaran. Selamat menonton!</p>
        </div>
        <button onclick="window.print()">Cetak Detail</button>
        <button><a href="history_pemesanan.php">Lihat History Pemesanan</a></button>
    </main>
    <script>
        //Opsional: Tambahkan konfirmasi sebelum mencetak
        function confirmPrint() {
            if (confirm("Apakah Anda yakin ingin mencetak detail pembayaran ini?")) {
                window.print();
            }
        }
    </script>
</body>
</html>
