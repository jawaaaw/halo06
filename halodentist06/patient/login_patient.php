<?php
session_start();
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM patients WHERE name = '$name'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['patient_logged_in'] = true;
        $_SESSION['patient_name'] = $user['name'];
        header("Location: patient_dashboard.php");
        exit();
    } else {
        $error = "Nama atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Pasien - Halo Dentist</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background-color: #fffaf6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background-color: #f0fdfd;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }
        h2 {
            color: #00838f;
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
            width: 100%;
            padding: 10px;
            background-color: #00acc1;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #00838f;
        }
        .note {
            font-size: 0.9em;
            margin-top: 10px;
            color: #555;
        }
        .note a {
            color: #00838f;
            text-decoration: none;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>👤 Login Pasien</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Nama Lengkap" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Masuk</button>
    </form>
    <p class="note">
        Belum punya akun? <a href="register_patient.php">Daftar di sini</a><br>
        <a href="forgot_password.php?role=patient">🔑 Lupa Password?</a>
    </p>
</div>
</body>
</html>
