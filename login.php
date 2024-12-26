<?php
session_start();
include 'service/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['alamat'] = $user['alamat'];  // Menambahkan alamat ke session
            $_SESSION['nomor_handphone'] = $user['nomor_handphone']; 
            header("Location: berandaa.php");
            exit();
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "Email dan Password Salah";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Bioskop</title>
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
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
            <h2>Login</h2>
            <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <p>Belum punya akun? <a href="signup.php">Daftar</a></p>
            <p><a href="forgot_password.php">Lupa Password?</a></p>
        </form>
    </div>
    <script src="js/login.js"></script>
</body>
</html>