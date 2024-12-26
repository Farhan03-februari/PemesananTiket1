<?php
include 'service/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = $_POST['code'];

    // Validasi OTP di database
    $stmt = $conn->prepare("SELECT * FROM users WHERE code = ? AND status > NOW()");
    $stmt->bind_param("s", $otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika OTP valid, arahkan ke halaman reset password
        $user = $result->fetch_assoc();

        // Menampilkan alert sebelum redirect
        echo "<script>
                alert('OTP valid. Anda akan diarahkan ke halaman reset password.');
                window.location.href = 'reset_password.php?user_id=" . $user['user_id'] . "';
              </script>";
        exit();
    } else {
        echo "<script>alert('OTP tidak valid atau sudah kadaluarsa.');</script>";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi OTP</title>
    <link rel="stylesheet" href="css/verify_otp.css?v=<?php echo time(); ?>">
</head>
<body>
    <form action="" method="POST">
        <label for="otp">Masukkan OTP:</label>
        <input type="number" id="code" name="code" required>
        <button type="submit">Verifikasi</button>
    </form>
</body>
</html>
