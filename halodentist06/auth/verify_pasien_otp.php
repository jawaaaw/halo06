<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['otp']) || !isset($_SESSION['register_patient_data'])) {
    header("Location: register_patient.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_otp = $_POST['otp'];
    if ($input_otp == $_SESSION['otp']) {
        $data = $_SESSION['register_patient_data'];
        $name = $data['name'];
        $phone = $data['phone'];
        $password = $data['password'];

        $check = mysqli_query($conn, "SELECT * FROM patients WHERE name = '$name'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Nama sudah terdaftar!";
        } else {
            $insert = mysqli_query($conn, "INSERT INTO patients (name, phone, password) VALUES ('$name', '$phone', '$password')");
            if ($insert) {
                unset($_SESSION['otp'], $_SESSION['register_patient_data']);
                header("Location: login_patient.php");
                exit();
            } else {
                $error = "Gagal menyimpan ke database.";
            }
        }
    } else {
        $error = "Kode OTP salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi OTP Pasien</title>
    <style>
        body {
            background-color: #fff8f0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .verify-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }
        input[type="text"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            padding: 10px;
            width: 100%;
            background-color: #00bcd4;
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
<div class="verify-box">
    <h2>🔐 Verifikasi OTP</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="otp" placeholder="Masukkan OTP" required>
        <button type="submit">Verifikasi</button>
    </form>
</div>
</body>
</html>
