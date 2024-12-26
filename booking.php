<?php 
session_start(); 
include 'service/db.php';  

if (!isset($_SESSION['user_id'])) {     
    header("Location: login.php");     
    exit; 
}

if (empty($_SESSION['alamat'])) {
    echo "Alamat tidak ada di session.";
}
if (empty($_SESSION['nomor_handphone'])) {
    echo "Nomor Handphone tidak ada di session.";
}

$user_id = $_SESSION['user_id']; 
$name = isset($_SESSION['username']) ? $_SESSION['username'] : ''; 
$alamat = isset($_SESSION['alamat']) ? $_SESSION['alamat'] : ''; 
$nomor_handphone = isset($_SESSION['nomor_handphone']) ? $_SESSION['nomor_handphone'] : ''; 

// Pastikan movie_id adalah angka
$movie_id = isset($_GET['movie_id']) && is_numeric($_GET['movie_id']) ? (int)$_GET['movie_id'] : 0;  

// Ambil detail film
$sql = "SELECT * FROM movies WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $movie_id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc(); 

// Ambil showtimes
$sql = "SELECT id, showtime, ticket_price FROM showtimes WHERE movie_id = ? ORDER BY showtime ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $movie_id);
$stmt->execute();
$result = $stmt->get_result();

$showtimes = [];
while ($row = $result->fetch_assoc()) {
    $showtimes[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $showtime_id = isset($_POST['showtime_id']) && is_numeric($_POST['showtime_id']) ? (int)$_POST['showtime_id'] : 0;
    $seats = isset($_POST['seats']) && is_numeric($_POST['seats']) ? (int)$_POST['seats'] : 0;

    // Pastikan showtime_id dan seats valid
    if ($showtime_id > 0 && $seats > 0) {
        $sql = "SELECT ticket_price FROM showtimes WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $showtime_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $showtime = $result->fetch_assoc();
        $ticket_price = $showtime['ticket_price']; 

        $total_price = $seats * $ticket_price;

        // Insert booking
        $sql = "INSERT INTO bookings (user_id, movie_id, showtime_id, seats, total_price) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iiiii', $user_id, $movie_id, $showtime_id, $seats, $total_price);

        if ($stmt->execute()) {
            header("Location: booking_detail.php?id=" . $stmt->insert_id);
            exit;
        } else {
            $error = "Terjadi kesalahan saat memesan tiket: " . $conn->error;
        }
    } else {
        $error = "Data yang dimasukkan tidak valid.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pemesanan Tiket</title>
    <link rel="stylesheet" href="css/booking.css?V=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="">
            <h1>Spot Cinema</h1>
        </div>
        
        <div class="back">
            <a href="movie_detail.php?id=<?php echo $movie_id; ?>" class="button">
                <i class='bx bx-arrow-back'></i> Back
            </a>
        </div>
    </header>

    <main>
        <div class="container-form">
            <div class="form-pemesanan">
                <h1>Form Pemesanan</h1>
            </div>

            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

            <form method="POST" action="">
                <div class="nama">
                    <label for="name">Nama Pemesan</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" readonly>
                </div>

                <div class="alamat">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($alamat); ?>" readonly>
                </div>

                <div class="nomor_handphone">
                    <label for="nomor_handphone">Nomor Handphone</label>
                    <input type="text" id="nomor_handphone" name="nomor_handphone" value="<?php echo htmlspecialchars($nomor_handphone); ?>" readonly>
                </div>

                <div class="judul-film">
                    <label for="judulFilm">Judul Film</label>
                    <input type="text" id="judulFilm" name="judulFilm" value="<?php echo htmlspecialchars($movie['title']); ?>" readonly>
                </div>

                <div class="waktu-tayang">
                    <label for="showtime">Waktu Tayang</label>
                    <select name="showtime_id" id="showtime" required>
                        <?php foreach ($showtimes as $showtime): ?>
                            <option value="<?php echo $showtime['id']; ?>"
                                data-tanggal="<?php echo date('d M Y H:i', strtotime($showtime['showtime'])); ?>"
                                data-harga="<?php echo number_format($showtime['ticket_price']); ?>">
                                <?php echo date('d M Y H:i', strtotime($showtime['showtime'])); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="jumlah-kursi">
                    <label>Jumlah Kursi</label>
                    <input type="number" name="seats" min="1" required>
                </div>

                <div class="butonPesan">
                    <button type="submit" id="submitButton" disabled>Pesan Tiket</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const showtimeSelect = document.querySelector('select[name="showtime_id"]');
            const seatsInput = document.querySelector('input[name="seats"]');
            const submitButton = document.querySelector('#submitButton');

            function validateForm() {
                // Validasi apakah semua input telah terisi
                if (showtimeSelect.value && seatsInput.value > 0) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            }

            // Event listener untuk setiap perubahan pada input
            showtimeSelect.addEventListener('change', validateForm);
            seatsInput.addEventListener('input', validateForm);

            // Inisialisasi status tombol saat pertama kali dimuat
            validateForm();
        });
    </script>
</body>
</html>
