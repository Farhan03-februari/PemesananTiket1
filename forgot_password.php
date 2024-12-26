<?php
include 'service/db.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Cek apakah email terdaftar
    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Buat token reset password
        $otp = random_int(100000, 999999);
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Simpan token ke database
        $conn->query("UPDATE users SET code = '$otp', status = '$expiry' WHERE email = '$email'");

        // Kirim email menggunakan PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'farhanannas123@gmail.com'; // Ganti dengan email Anda
            $mail->Password = 'umky tpaw vmkb snys'; // Ganti dengan password email Anda
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('farhanannas123@gmail.com', 'Your Website'); // Sesuaikan
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset Password';
            $mail->Body = "Klik link berikut untuk mereset password Anda: <a href='http://localhost/pemesananTiket/verify_otp.php?token=$token'>Reset Password</a>
                            <p>Token Anda adalah: <strong>$otp</strong></p>
                            <p>Token ini hanya berlaku selama 1 jam.</p>
            ";


            $mail->send();
            echo "<script>alert('Kode Verivikasi Sudah Di kirim Silahkan Cek Email');
            window.location.href = 'verify_otp.php?user_id=" . $user['user_id'] . "';
            </script>";
        } catch (Exception $e) {
            echo "Email gagal dikirim. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Email Salah.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/forgot_password.css?v=<?php echo time(); ?>">
</head>
<body>
        <form action="" method="POST">
            <label for="email">Masukkan Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Reset Password</button>
        </form>
</body>
</html>
