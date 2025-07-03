<?php
session_start();
include '../includes/db.php';
 // pastikan file db.php menghubungkan ke database

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua input tersedia
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : '';
    $phone = isset($_POST["phone"]) ? trim($_POST["phone"]) : '';
    $password_input = isset($_POST["new_password"]) ? trim($_POST["new_password"]) : '';

    if ($username && $phone && $password_input) {
        $new_password = password_hash($password_input, PASSWORD_DEFAULT);

        // Gunakan nama kolom yang benar di database
        $stmt = $conn->prepare("SELECT id FROM doctors WHERE name = ? AND phone = ?");
        if ($stmt) {
            $stmt->bind_param("ss", $username, $phone);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                // Update password
                $update = $conn->prepare("UPDATE doctors SET password = ? WHERE name = ? AND phone = ?");
                $update->bind_param("sss", $new_password, $username, $phone);
                if ($update->execute()) {
                    $success = "Password berhasil direset! Silakan login kembali.";
                } else {
                    $error = "Gagal mengupdate password.";
                }
                $update->close();
            } else {
                $error = "Data dokter tidak cocok.";
            }
            $stmt->close();
        } else {
            $error = "Kesalahan server: " . $conn->error;
        }
    } else {
        $error = "Semua field harus diisi.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - Halo Dentist</title>
    <style>
        body {
            background-color: #fff6f4;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .reset-box {
            background-color: #ffe0e8;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 {
            text-align: center;
            color: #c0392b;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .message {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
<div class="reset-box">
    <h2>🔐 Lupa Password</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Nama / Username" required>
        <input type="text" name="phone" placeholder="No Telepon" required>
        <input type="password" name="new_password" placeholder="Password Baru" required>
        <button type="submit">Reset Password</button>
    </form>

    <?php if (!empty($success)) echo "<p class='message success'>$success</p>"; ?>
    <?php if (!empty($error)) echo "<p class='message error'>$error</p>"; ?>
</div>
</body>
</html>
