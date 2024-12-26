<?php
session_start();
include 'service/db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil daftar film
$sql = "SELECT * FROM movies ORDER BY created_at LIMIT 6";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Beranda</title>
    <link rel="stylesheet" href="css/beranda.css">
</head>
<body>
    <header>
        <h1>Selamat Datang di Pemesanan Tiket Bioskop</h1>
    </header>
    <main>
        <h2>Daftar Film</h2>
        <section class="home">
        <div class="movies">
            <?php while ($movie = $result->fetch_assoc()): ?>
                <div class="movie">
                    <img src="images/<?php echo $movie['image_url']; ?>" alt="<?php echo $movie['title']; ?>">
                    <h3><?php echo $movie['title']; ?></h3>
                    <h3><?php echo $movie['genre']; ?></h3>
                    <p><?php echo substr($movie['description'], 0, 100); ?></p>
                    <p><strong>Harga: </strong><?php echo $movie['harga']; ?></p>
                    <a href="movie_detail.php?id=<?php echo $movie['id']; ?>">Lihat Detail</a>
                </div>
        </div>
            <?php endwhile; ?>
        </div>
        </section>
    </main>

    <div class="container-logout">
        <form action="logout.php" method="POST" class="login-email">
            <h1>Selamat datang, <?php echo $_SESSION['username']; ?>!</h1>
            <div class="input-group">
                <button type="submit" class="btn">Logout</button>
            </div>
        </form>
        </div>

        <section class="deskripsiFilm">
            <div class="filmTerpopuler">
                <h1>Film Terpopuler</h1>
                <div class="containerFilm">
                    <div class="posterFilm">
                        <img src="images/ancika.png" alt="Twilight Poster">
                    </div>
                    <div class="film-info">
                        <p>Jenis Film:</p>
                        <p>Romance</p><br>
                        <p>Produser:</p>
                        <p>Stephenie Meyer, Wyck Godfrey</p><br>
                        <p>Produksi:</p>
                        <p>Submit Entertainment</p><br>
                        <p>Home Page:</p>
                        <p><a href="http://www.breakingdawn-themovie.com/" target="_blank">http://www.breakingdawn-themovie.com/</a></p><br>
                        <p>Durasi:</p>
                        <p>112 Menit</p>
                    </div>
                </div>

                <div class="containerFilm2">
                    <div class="posterFilm">
                        <img src="images/ancika.png" alt="Twilight Poster">
                    </div>
                    <div class="film-info">
                        <p>Jenis Film:</p>
                        <p>Romance</p><br>
                        <p>Produser:</p>
                        <p>Stephenie Meyer, Wyck Godfrey</p><br>
                        <p>Produksi:</p>
                        <p>Submit Entertainment</p><br>
                        <p>Home Page:</p>
                        <p><a href="http://www.breakingdawn-themovie.com/" target="_blank">http://www.breakingdawn-themovie.com/</a></p><br>
                        <p>Durasi:</p>
                        <p>112 Menit</p>
                    </div>
                </div>

                    <div class="containerFilm3">
                    <div class="posterFilm">
                        <img src="images/ancika.png" alt="Twilight Poster">
                    </div>
                    <div class="film-info">
                        <p>Jenis Film:</p>
                        <p>Romance</p><br>
                        <p>Produser:</p>
                        <p>Stephenie Meyer, Wyck Godfrey</p><br>
                        <p>Produksi:</p>
                        <p>Submit Entertainment</p><br>
                        <p>Home Page:</p>
                        <p><a href="http://www.breakingdawn-themovie.com/" target="_blank">http://www.breakingdawn-themovie.com/</a></p><br>
                        <p>Durasi:</p>
                        <p>112 Menit</p>
                    </div>
                </div>
                </div>

                <br>

            <div class="filmTerbaru">
            <h1>Film Terbaru</h1>
            <div class="containerFilm4">
                <div class="posterFilm">
                    <img src="images/ancika.png" alt="Twilight Poster">
                </div>
                <div class="film-info">
                    <p>Jenis Film:</p>
                    <p>Romance</p><br>
                    <p>Produser:</p>
                    <p>Stephenie Meyer, Wyck Godfrey</p><br>
                    <p>Produksi:</p>
                    <p>Submit Entertainment</p><br>
                    <p>Home Page:</p>
                    <p><a href="http://www.breakingdawn-themovie.com/" target="_blank">http://www.breakingdawn-themovie.com/</a></p><br>
                    <p>Durasi:</p>
                    <p>112 Menit</p>
                </div>
            </div>

            <div class="containerFilm5">
                <div class="posterFilm">
                    <img src="images/ancika.png" alt="Twilight Poster">
                </div>
                <div class="film-info">
                    <p>Jenis Film:</p>
                    <p>Romance</p><br>
                    <p>Produser:</p>
                    <p>Stephenie Meyer, Wyck Godfrey</p><br>
                    <p>Produksi:</p>
                    <p>Submit Entertainment</p><br>
                    <p>Home Page:</p>
                    <p><a href="http://www.breakingdawn-themovie.com/" target="_blank">http://www.breakingdawn-themovie.com/</a></p><br>
                    <p>Durasi:</p>
                    <p>112 Menit</p>
                </div>
            </div>

            <div class="containerFilm6">
                <div class="posterFilm">
                    <img src="images/ancika.png" alt="Twilight Poster">
                </div>
                <div class="film-info">
                    <p>Jenis Film:</p>
                    <p>Romance</p><br>
                    <p>Produser:</p>
                    <p>Stephenie Meyer, Wyck Godfrey</p><br>
                    <p>Produksi:</p>
                    <p>Submit Entertainment</p><br>
                    <p>Home Page:</p>
                    <p><a href="http://www.breakingdawn-themovie.com/" target="_blank">http://www.breakingdawn-themovie.com/</a></p><br>
                    <p>Durasi:</p>
                    <p>112 Menit</p>
                </div>
            </div>

            <div class="containerFilm7">
                <div class="posterFilm">
                    <img src="images/ancika.png" alt="Twilight Poster">
                </div>
                <div class="film-info">
                    <p>Jenis Film:</p>
                    <p>Romance</p><br>
                    <p>Produser:</p>
                    <p>Stephenie Meyer, Wyck Godfrey</p><br>
                    <p>Produksi:</p>
                    <p>Submit Entertainment</p><br>
                    <p>Home Page:</p>
                    <p>Durasi:</p>
                    <p>112 Menit</p>
                </div>
            </div>

            <div class="containerFilm8">
                <div class="posterFilm">
                    <img src="images/ancika.png" alt="Twilight Poster">
                </div>
                <div class="film-info">
                    <p>Jenis Film:</p>
                    <p>Romance</p><br>
                    <p>Produser:</p>
                    <p>Stephenie Meyer, Wyck Godfrey</p><br>
                    <p>Produksi:</p>
                    <p>Submit Entertainment</p><br>
                    <p>Home Page:</p>
                    <p><a href="http://www.breakingdawn-themovie.com/" target="_blank">http://www.breakingdawn-themovie.com/</a></p><br>
                    <p>Durasi:</p>
                    <p>112 Menit</p>
                </div>
            </div>

            <div class="containerFilm9">
                <div class="posterFilm">
                    <img src="images/ancika.png" alt="Twilight Poster">
                </div>
                <div class="film-info">
                    <p>Jenis Film:</p>
                    <p>Romance</p><br>
                    <p>Produser:</p>
                    <p>Stephenie Meyer, Wyck Godfrey</p><br>
                    <p>Produksi:</p>
                    <p>Submit Entertainment</p><br>
                    <p>Home Page:</p>
                    <p><a href="http://www.breakingdawn-themovie.com/" target="_blank">http://www.breakingdawn-themovie.com/</a></p><br>
                    <p>Durasi:</p>
                    <p>112 Menit</p>
                </div>
            </div>
            </div>
            
        </section>
</body>
</html>
