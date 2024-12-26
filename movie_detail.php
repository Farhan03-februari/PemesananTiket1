<?php
session_start();
include 'service/db.php';

// Ambil detail film berdasarkan ID
$id = $_GET['id'];
$sql = "SELECT * FROM movies WHERE id = $id";
$result = $conn->query($sql);
$movie = $result->fetch_assoc();

if (!$movie) {
    die("Film tidak ditemukan.");
}

$sql = "SELECT showtime, ticket_price FROM showtimes WHERE movie_id = $id ORDER BY showtime ASC";
$result = $conn->query($sql);
$showtimes = [];
while ($row = $result->fetch_assoc()) {
    $showtimes[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $movie['title']; ?> - Detail Film</title>
    <link rel="stylesheet" href="css/movie-detail.css?V=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <h1>Spot Cinema</h1>
        <div class="back">
            <a href="berandaa.php?movie_id=<?php echo $movie['id']; ?>" class="button">
                <i class='bx bx-arrow-back'></i> Back
            </a>
        </div>
    </header>
    <main>
        <div class="container-desFilm">
            <div class="foto-film">
                <img src="images/<?php echo $movie['image_url']; ?>" alt="<?php echo $movie['title']; ?>" class="movie-image movie-<?php echo $movie['id']; ?>"  data-id="<?php echo $movie['id']; ?>">>
            </div>
            <div class="deskripsi-film">
                <p><strong class="label">Judul Film</strong> <span class="value"><?php echo $movie['title']; ?></span></p>
                <p><strong class="label">Genre</strong> <span class="value"><?php echo $movie['genre']; ?></span></p>
                <p><strong class="label">Durasi</strong> <span class="value"><?php echo $movie['duration']; ?></span></p>
                <p><strong class="label">Rilis</strong> <span class="value"><?php echo $movie['release_date']; ?></span></p>
                <p><strong class="label">Rating</strong> <span class="value"><?php echo $movie['rating']; ?></span></p>
                <p><strong class="label">Harga</strong> <span class="value"><?php echo $movie['harga']; ?></span></p>
                <p><strong class="label">Studio</strong> <span class="value"><?php echo $movie['studio']; ?></span></p>
                <div class="jadwal-tayang">
                <?php if (!empty($showtimes)): ?>
                    <div id="showtime-list">
                        <?php foreach ($showtimes as $showtime): ?>
                            <p><strong class="label">Jadwal Tayang</strong> <span class="value"><?php echo date('d M Y H:i', strtotime($showtime['showtime'])); ?> </span></p>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p id="no-showtimes">Belum ada jadwal tayang untuk film ini.</p>
                <?php endif; ?>
                </div>
                <p><strong class="label">Deskripsi</strong> <span class="value"><?php echo $movie['description']; ?></span></p>
            </div>
        </div>
        <div class="button-tiket">
            <a href="booking.php?movie_id=<?php echo $movie['id']; ?>"  id="bookingButton" class="button">Pesan Tiket</a>
        </div>
        
    </main>

    <script>
        const showtimesList = document.getElementById('showtimes-list');
        const noShowtimesMessage = document.getElementById('no-showtimes');
        const bookingButton = document.getElementById('bookingButton');

        if (showtimesList && showtimesList.children.length === 0 || noShowtimesMessage) {
            // Jika tidak ada jadwal tayang, nonaktifkan tombol Pesan Tiket
            bookingButton.disabled = true;
            bookingButton.style.pointerEvents = 'none'; // Menonaktifkan interaksi pada tombol
            bookingButton.style.opacity = 0.5; // Membuat tombol tampak tidak aktif
        } else {
            // Jika ada jadwal tayang, tombol Pesan Tiket diaktifkan
            bookingButton.disabled = false;
            bookingButton.style.pointerEvents = 'auto'; // Memungkinkan interaksi dengan tombol
            bookingButton.style.opacity = 1; // Mengembalikan opacity ke normal
        }
    </script>
</body>
</html>

