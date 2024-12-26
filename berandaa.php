<?php
session_start();
include 'service/db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM movies LIMIT 9";
$result = $conn->query($sql);

$film1 = $result->fetch_assoc();
$film2 = $result->fetch_assoc();
$film3 = $result->fetch_assoc();
$film4 = $result->fetch_assoc();
$film5 = $result->fetch_assoc();
$film6 = $result->fetch_assoc();
$film7 = $result->fetch_assoc();
$film8 = $result->fetch_assoc();
$film9 = $result->fetch_assoc();

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
            <img src="images/logo.png" alt="">
            <div class="title">
                <h1>Spot Cinema</h1>
                <p>Pesan Tiket Anda Sekarang Juga, sebelum Habis...</p>
            </div>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="berandaa.php">Home</a></li>
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

    <main>
        <h1><i>Selamat Datang <?php echo $_SESSION['username']; ?>!</i></h1>
        <section>
            <div class="container-populer">
                <h1 class="title-populer">film Terpopuler</h1>
                <div class="movie-gallery">
                    <?php if ($film1): ?>
                        <div class="container-cardt">
                            <div class="movie-card">
                                <img src="images/<?php echo $film1['image_url']; ?>" alt="<?php echo $film1['title']; ?>">
                                <h3><?php echo $film1['title']; ?></h3>
                                <p><?php echo $film1['harga']; ?></p>
                                <a href="movie_detail.php?id=<?php echo $film1['id']; ?>">Lihat Detail</a>
                            </div>
                        </div>
                        <?php endif; ?>

                    <?php if ($film2): ?>
                        <div class="container-cardt">
                            <div class="movie-card">
                                <img src="images/<?php echo $film2['image_url']; ?>" alt="<?php echo $film2['title']; ?>">
                                <h3><?php echo $film2['title']; ?></h3>
                                <p><?php echo $film2['harga']; ?></p>
                                <a href="movie_detail.php?id=<?php echo $film2['id']; ?>">Lihat Detail</a>
                            </div>
                        </div>
                        <?php endif; ?>

                    <?php if ($film3): ?>
                        <div class="container-cardt">
                            <div class="movie-card">
                                <img src="images/<?php echo $film3['image_url']; ?>" alt="<?php echo $film3['title']; ?>">
                                <h3><?php echo $film3['title']; ?></h3>
                                <p><?php echo $film3['harga']; ?></p>
                                <a href="movie_detail.php?id=<?php echo $film3['id']; ?>">Lihat Detail</a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
            </div>

            <div class="container-terbaru">
            <h1 class="title-terbaru">Film Terbaru</h1>
            <div class="film-terbaru">
            <?php if ($film4): ?>
            <div class="container-card">
                <div class="movie-card">
                    <img src="images/<?php echo $film4['image_url']; ?>" alt="<?php echo $film4['title']; ?>">
                    <h3><?php echo $film4['title']; ?></h3>
                    <p><?php echo $film4['harga']; ?></p>
                    <a href="movie_detail.php?id=<?php echo $film4['id']; ?>" class="button">Lihat Detail</a>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($film5): ?>
            <div class="container-card">
                <div class="movie-card">
                    <img src="images/<?php echo $film5['image_url']; ?>" alt="<?php echo $film5['title']; ?>">
                    <h3><?php echo $film5['title']; ?></h3>
                    <p><?php echo $film5['harga']; ?></p>
                    <a href="movie_detail.php?id=<?php echo $film5['id']; ?>" class="button">Lihat Detail</a>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($film6): ?>
            <div class="container-card">
                <div class="movie-card">
                    <img src="images/<?php echo $film6['image_url']; ?>" alt="<?php echo $film6['title']; ?>">
                    <h3><?php echo $film6['title']; ?></h3>
                    <p><?php echo $film6['harga']; ?></p>
                    <a href="movie_detail.php?id=<?php echo $film6['id']; ?>" class="button">Lihat Detail</a>
                </div>
            </div>
            <?php endif; ?>
            </div>

    
            <div class="film-terbaru">
            <?php if ($film7): ?>
            <div class="container-card">
                <div class="movie-card">
                    <img src="images/<?php echo $film7['image_url']; ?>" alt="<?php echo $film7['title']; ?>">
                    <h3><?php echo $film7['title']; ?></h3>
                    <p><?php echo $film7['harga']; ?></p>
                    <a href="movie_detail.php?id=<?php echo $film7['id']; ?>" class="button">Lihat Detail</a>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($film8): ?>
            <div class="container-card">
                <div class="movie-card">
                    <img src="images/<?php echo $film8['image_url']; ?>" alt="<?php echo $film8['title']; ?>">
                    <h3><?php echo $film8['title']; ?></h3>
                    <p><?php echo $film8['harga']; ?></p>
                    <a href="movie_detail.php?id=<?php echo $film8['id']; ?>" class="button">Lihat Detail</a>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($film9): ?>
            <div class="container-card">
                <div class="movie-card">
                    <img src="images/<?php echo $film9['image_url']; ?>" alt="<?php echo $film9['title']; ?>">
                    <h3><?php echo $film9['title']; ?></h3>
                    <p><?php echo $film9['harga']; ?></p>
                    <a href="movie_detail.php?id=<?php echo $film9['id']; ?>" class="button">Lihat Detail</a>
                </div>
            </div>
            <?php endif; ?>
            </div>
            </div>
            </div>
        </section>
    </main>
</body>
</html>
