<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['otp']) || !isset($_SESSION['register_doctor_data'])) {
    header("Location: register_doctor.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_otp = $_POST['otp'];

    if ($input_otp == $_SESSION['otp']) {
        $data = $_SESSION['register_doctor_data'];
        $name = $data['name'];
        $username = $data['username'];
        $phone = $data['phone'];
        $password = $data['password'];

        $insert = mysqli_query($conn, "INSERT INTO doctors (name, username, phone, password, is_verified) VALUES ('$name', '$username', '$phone', '$password', 1)");

        unset($_SESSION['otp']);
        unset($_SESSION['register_doctor_data']);

        if ($insert) {
            header("Location: login_doctor.php");
            exit();
        } else {
            $error = "Gagal menyimpan data. Coba lagi.";
        }
    } else {
        $error = "Kode OTP salah. Coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi OTP Dokter</title>
    <style>
        body {
            background-color: #fff8f0;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .otp-box {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            color: #6b3e26;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #b77960;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="otp-box">
    <h2>🔒 Verifikasi OTP</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="otp" placeholder="Masukkan Kode OTP" required>
        <button type="submit">Verifikasi</button>
    </form>
</div>
</body>
</html>
