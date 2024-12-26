<?php
session_start();
include 'service/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$booking_id = $_GET['id'];
$username = $_SESSION['username'];

// Ambil detail pemesanan
$sql = "SELECT bookings.*, movies.title FROM bookings INNER JOIN movies ON bookings.movie_id = movies.id WHERE bookings.id = $booking_id";
$result = $conn->query($sql);
$booking = $result->fetch_assoc();

if (!$booking) {
    die("Pemesanan tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_method = $_POST['payment_method'];

    // Perbarui status pembayaran menjadi "completed"
    $sql = "UPDATE bookings SET payment_status = 'completed' WHERE id = $booking_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: payment_detail.php?id=$booking_id");
        exit;
    } else {
        $error = "Terjadi kesalahan: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pembayaran</title>
    <link rel="stylesheet" href="css/payment.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="">
            <h1>Spot Cinema</h1>
        </div>
        <div class="back">
        <a href="booking_detail.php?id=<?php echo $booking_id; ?>" class="button">
            <i class='bx bx-arrow-back'></i> Back
        </a>
        </div>
    </header>
    <main>
        <div class="pembayaran">
            <h1>Pembayaran</h1>
            <p><strong class="label">Nama Pemesan</strong> <span class="value"><?php echo htmlspecialchars($username); ?></span></p>
            <p><strong class="label"> Judul Film</strong> <span class="value"><?php echo $booking['title']; ?></span></p>
            <p><strong class="label">Total Harga</strong> <span class="value"><?php echo number_format($booking['total_price'], 0, ',', '.'); ?></span></p>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form method="POST" action="">
                <label>Metode Pembayaran</label>
                <select name="payment_method" required>
                    <option value="credit_card">Kartu Kredit</option>
                    <option value="bank_transfer">Transfer Bank</option>
                    <option value="e-wallet">E-Wallet</option>
                </select>
                <button class="button1" type="submit">Bayar Sekarang</button>
            </form>
        </div>
    </main>
</body>
</html>
