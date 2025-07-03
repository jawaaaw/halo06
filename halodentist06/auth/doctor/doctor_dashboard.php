<?php
session_start();
include '../includes/db.php';


if (!isset($_SESSION['doctor_logged_in'])) {
    header("Location: login_doctor.php");
    exit();
}

$doctor_name = $_SESSION['doctor_name'];
$query = "SELECT schedules.*, patients.name AS patient_name FROM schedules 
          JOIN patients ON schedules.patient_name = patients.name
          JOIN doctors ON schedules.doctor_id = doctors.id
          WHERE doctors.name = '$doctor_name' 
          ORDER BY date, time";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Dokter</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            color: #004d40;
        }
        .nav {
            text-align: center;
            margin-bottom: 20px;
        }
        .nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #00796b;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #00796b;
            color: white;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #d32f2f;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .logout-btn:hover {
            background-color: #b71c1c;
        }
    </style>
</head>
<body>
<div class="header">
    <h2>👨‍⚕️ Selamat datang, <?= htmlspecialchars($doctor_name) ?></h2>
    <a class="logout-btn" href="logout_doctor.php">Logout</a>
</div>
<div class="nav">
    <a href="index.php">🏠 Beranda</a>
    <a href="login_doctor.php">👨‍⚕️ Login Dokter</a>
    <a href="register_doctor.php">📝 Daftar Dokter</a>
</div>
<h3>📅 Jadwal Konsultasi Anda</h3>
<table>
    <tr>
        <th>Nama Pasien</th>
        <th>Tanggal</th>
        <th>Jam</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td><?= $row['patient_name'] ?></td>
        <td><?= $row['date'] ?></td>
        <td><?= $row['time'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
