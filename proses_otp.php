<?php
include 'service/db.php';
$conn->query("SET time_zone = '+07:00'");

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
        header("Location: reset_password.php?user_id=" . $user['user_id']);
        exit();
    } else {
        echo "OTP tidak valid atau sudah kadaluarsa.";
    }
}
?>
