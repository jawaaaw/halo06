<?php
session_start();
include '../includes/db.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek user dan password (sementara hardcoded)
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin/admin_dashboard.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin - Halo Dentist</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background-color: #fef7f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background-color: #fff8f0;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }
        h2 {
            color: #8b4c39;
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
            background-color: #d18b73;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #b77960;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .note {
            font-size: 0.9em;
            margin-top: 10px;
            color: #777;
        }
        .note a {
            color: #b77960;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Login Admin</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p class="note">
    <a href="forgot_password.php?role=admin">🔑 Lupa Password?</a>
</p>
</div>
</body>
</html>
