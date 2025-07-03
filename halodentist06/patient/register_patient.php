<?php
session_start();
include '../includes/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM patients WHERE name = '$name'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Nama sudah terdaftar!'); window.location.href='register_patient.php';</script>";
    } else {
        mysqli_query($conn, "INSERT INTO patients (name, phone, password) VALUES ('$name', '$phone', '$password')");
        echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location.href='login_patient.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pasien Baru</title>
    <style>
        body {
            background-color: #fff8f0;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .form-box {
            background-color: #ffe6f2;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }
        h2 {
            color: #d63384;
        }
        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 10px;
            background-color: #fff;
        }
        button {
            background-color: #ff80ab;
            border: none;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #ff4d88;
        }
        .note {
            font-size: 0.9em;
            margin-top: 10px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="form-box">
    <h2>📝 Daftar Pasien Baru</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Nama Lengkap" required><br>
        <input type="text" name="phone" placeholder="No Telepon" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Daftar Sekarang</button>
    </form>
    <p class="note">Sudah punya akun? <a href="login_patient.php">Login di sini</a></p>
</div>
</body>
</html>
