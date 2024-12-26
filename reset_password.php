<?php
include 'service/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi ID pengguna
    if (!filter_var($user_id, FILTER_VALIDATE_INT)) {
        echo "<script>alert('ID pengguna tidak valid.');</script>";
        exit();
    }

    // Validasi password
    if (strlen($password) < 8) {
        echo "<script>alert('Password harus memiliki minimal 8 karakter.');</script>";
        exit();
    }

    if ($password === $confirm_password) {
        $plain_password = $password;

        // Update password di database
        $stmt = $conn->prepare("UPDATE users SET password = ?, code = NULL, status = NULL WHERE user_id = ?");
        if (!$stmt) {
            echo "<script>alert('Kesalahan prepare statement: {$conn->error}');</script>";
            exit();
        }

        $stmt->bind_param("si", $plain_password, $user_id);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Password berhasil diperbarui. Silakan login dengan password baru.');
                    window.location.href = 'login.php'; // Redirect ke halaman login
                  </script>";
            exit();
        } else {
            echo "<script>alert('Gagal memperbarui password: {$conn->error}');</script>";
        }
    } else {
        echo "<script>alert('Password dan konfirmasi password tidak sama.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/reset_password.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="header">
        <h2>Reset Password</h2>
    </div>
    <form action="" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
        <label for="password">Password Baru:</label>
        <input type="password" id="password" name="password" required>
        <label for="confirm_password">Konfirmasi Password Baru:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
