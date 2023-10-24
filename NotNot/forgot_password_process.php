<?php
// Sisipkan file koneksi database
include 'database.php';

if (isset($_POST['reset_password'])) {
    // Ambil username dan password baru dari formulir
    $username = $_POST['username'];
    $newPassword = $_POST['password'];

    // Validasi apakah username ada dalam database
    $query = "SELECT * FROM datauser WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Username ditemukan, hash password baru
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Update password pengguna
        $updateQuery = "UPDATE datauser SET password = '$hashedPassword' WHERE username = '$username'";
        if (mysqli_query($conn, $updateQuery)) {
            // Password berhasil direset
            header('Location: login.php'); // Redirect ke halaman login
        } else {
            // Gagal mengupdate password
            header('Location: forgot_password.php?error=1');
        }
    } else {
        // Username tidak ditemukan
        header('Location: forgot_password.php?error=1');
    }
}
?>
