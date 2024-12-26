<?php
include 'service/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $nomor_handphone = $conn->real_escape_string($_POST['nomor_handphone']);
    $password = $conn->real_escape_string($_POST['password']); // Tidak di-hash

    // Validasi nomor handphone
    if (!preg_match('/^[0-9+]+$/', $nomor_handphone)) {
        $error = "Nomor handphone hanya boleh mengandung angka atau simbol +.";
    } else {
        // Cek apakah username atau email sudah terdaftar
        $check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            $error = "Username atau email sudah terdaftar";
        } else {
            // Simpan data ke database tanpa hashing password
            $insert_query = "INSERT INTO users (username, email, alamat, nomor_handphone, password) VALUES ('$username', '$email', '$alamat', '$nomor_handphone', '$password')";

            if ($conn->query($insert_query) === TRUE) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Pendaftaran gagal: " . $conn->error;
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="css/signUp.css?v=<?php echo time(); ?>">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="">
            <h1>Spot Cinema</h1>
        </div>
    </header>
    <div class="login-container">
        <form method="POST" action="" class="login-form">
            <h2>Daftar Akun</h2>
            <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <input type="text" name="nomor_handphone" placeholder="No Handphone" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Daftar</button>
            <p>Sudah punya akun? <a href="login.php">Login</a></p>
        </form>
    </div>
    <script src="js/signup.js"></script>
</body>
</html>