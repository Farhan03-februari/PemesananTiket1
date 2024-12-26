<?php
include 'service/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi ID pengguna
    if (!filter_var($user_id, FILTER_VALIDATE_INT)) {
        echo "ID pengguna tidak valid.";
        exit();
    }

    // Validasi password
    if (strlen($password) < 8) {
        echo "Password harus memiliki minimal 8 karakter.";
        exit();
    }

    if ($password === $confirm_password) {
        $plain_password = $password;

        // Update password di database
        $stmt = $conn->prepare("UPDATE users SET password = ?, code = NULL, status = NULL WHERE user_id = ?");
        if (!$stmt) {
            echo "Kesalahan prepare statement: " . $conn->error;
            exit();
        }

        $stmt->bind_param("si", $plain_password, $user_id);

        if ($stmt->execute()) {
            echo "Password berhasil diperbarui. Silakan login dengan password baru.";
        } else {
            echo "Gagal memperbarui password: " . $conn->error;
        }
    } else {
        echo "Password dan konfirmasi password tidak sama.";
    }
}
?>
