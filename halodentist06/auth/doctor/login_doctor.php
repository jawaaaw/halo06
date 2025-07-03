<?php
session_start();
include '../includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM doctors WHERE LOWER(name) = LOWER(?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctor = $result->fetch_assoc();

    if ($doctor && password_verify($password, $doctor['password'])) {
        $_SESSION['doctor_logged_in'] = true;
        $_SESSION['doctor_name'] = $doctor['name'];
        $_SESSION['doctor_id'] = $doctor['id'];
        header("Location: doctor_dashboard.php");
        exit();
    } else {
        $error = "Nama atau password salah!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Dokter</title>
    <style>
        body {
            background-color: #f1f9ff;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: #fff;
            padding: 30px 35px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #00778b;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #00778b;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background-color: #005f6b;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
        }

        .links {
            margin-top: 15px;
            font-size: 14px;
        }

        .links a {
            color: #00778b;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>👨‍⚕️ Login Dokter</h2>

        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <label>Nama Dokter</label>
                <input type="text" name="name" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Masuk</button>
        </form>

        <div class="links">
            Belum punya akun? <a href="register_doctor.php">Daftar di sini</a><br>
            🔑 <a href="forgot_password.php">Lupa Password?</a>
        </div>
    </div>
</body>
</html>
