<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn, "SELECT * FROM patients WHERE name = '$name' AND phone = '$phone'");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($conn, "UPDATE patients SET password = '$new_password' WHERE name = '$name'");
        $success = "Password berhasil diubah. Silakan login kembali.";
    } else {
        $error = "Data tidak cocok. Nama atau No HP salah.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password Pasien</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Reset Password</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <form method="POST">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="name" required><br><br>

        <label>No HP:</label><br>
        <input type="text" name="phone" required><br><br>

        <label>Password Baru:</label><br>
        <input type="password" name="new_password" required><br><br>

        <button type="submit">Ubah Password</button>
    </form>
    <br>
    <a href="login_patient.php">Kembali ke Login</a>
</body>
</html>
