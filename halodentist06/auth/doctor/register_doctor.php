<?php
session_start();
include '../includes/db.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah nama dokter sudah terdaftar
    $stmt = $conn->prepare("SELECT id FROM doctors WHERE LOWER(name) = LOWER(?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Nama dokter sudah terdaftar.";
    } else {
        // Insert dokter baru (tambahkan 'phone' kalau ada kolomnya)
        $insert = $conn->prepare("INSERT INTO doctors (name, password, phone, is_verified) VALUES (?, ?, ?, 0)");
        $insert->bind_param("sss", $name, $hashedPassword, $phone);
        if ($insert->execute()) {
            $success = "Registrasi berhasil! Silakan login.";
        } else {
            $error = "Gagal mendaftar. Coba lagi.";
        }
        $insert->close();
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Dokter</title>
    <style>
        body {
            background-color: #fef9f8;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #e91e63;
        }
        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        button {
            background-color: #e91e63;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #d81b60;
        }
        .message {
            font-size: 0.9em;
            margin: 10px 0;
        }
        .error { color: red; }
        .success { color: green; }
        .note {
            margin-top: 10px;
            font-size: 0.85em;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>🩺 Daftar Dokter</h2>

    <?php if ($error): ?>
        <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="message success"><?= htmlspecialchars($success) ?><br>
            <a href="login_doctor.php">Login Sekarang</a></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Nama Dokter" required>
        <input type="text" name="phone" placeholder="No Telepon" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Daftar</button>
    </form>

    <p class="note">Sudah punya akun? <a href="login_doctor.php">Login di sini</a></p>
</div>
</body>
</html>
