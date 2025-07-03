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
</head>
<body>
<header>
    <h1>Selamat Datang, <?= htmlspecialchars($patient_name) ?></h1>
    <nav>
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
