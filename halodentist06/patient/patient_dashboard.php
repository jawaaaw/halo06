<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['patient_logged_in'])) {
    header("Location: login_patient.php");
    exit();
}

$patient_name = $_SESSION['patient_name'];

// Cek apakah pasien sudah punya nomor HP
$cek_phone = mysqli_query($conn, "SELECT phone FROM patients WHERE name = '$patient_name'");
$data = mysqli_fetch_assoc($cek_phone);
if (empty($data['phone'])) {
    header("Location: update_phone.php");
    exit();
}

$query = "SELECT schedules.*, doctors.name AS doctor_name 
          FROM schedules 
          JOIN doctors ON schedules.doctor_id = doctors.id 
          WHERE patient_name = '$patient_name' 
          ORDER BY date, time";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pasien</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff9f5;
            color: #4b2e2e;
        }
        header {
            background-color: #fce4ec;
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid #d7ccc8;
        }
        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #6a1b9a;
            font-weight: bold;
        }
        h2 {
            text-align: center;
            margin-top: 40px;
            color: #5d4037;
        }
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        th, td {
            padding: 14px;
            border: 1px solid #c7b299;
            text-align: center;
        }
        th {
            background-color: #ffe0b2;
            color: #4e342e;
        }
        tr:nth-child(even) {
            background-color: #fff3e0;
        }
        tr:hover {
            background-color: #ffe9e0;
        }
    </style>
</head>
<body>
<header>
    <h1>Selamat Datang, <?= htmlspecialchars($patient_name) ?></h1>
    <nav>
        <a href="update_phone.php">Ubah Nomor HP</a>
        <a href="logout_patient.php">Logout</a>
    </nav>
</header>
<main>
    <h2>Jadwal Konsultasi Anda</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Dokter</th>
            <th>Tanggal</th>
            <th>Jam</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>$no</td>
                    <td>{$row['doctor_name']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['time']}</td>
                  </tr>";
            $no++;
        }
        ?>
    </table>
</main>
</body>
</html>
