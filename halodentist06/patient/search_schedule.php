<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$query = "SELECT schedules.*, doctors.name AS doctor_name FROM schedules 
          JOIN doctors ON schedules.doctor_id = doctors.id 
          WHERE doctors.name LIKE '%$keyword%' OR schedules.date LIKE '%$keyword%' 
          ORDER BY schedules.date, schedules.time";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pencarian Jadwal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Pencarian Jadwal Dokter</h2>
    <a href="admin_dashboard.php">Kembali ke Dashboard</a>
    <form method="GET">
        <input type="text" name="keyword" placeholder="Cari nama dokter atau tanggal" value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">Cari</button>
    </form>
    <br>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Pasien</th>
            <th>Dokter</th>
            <th>Tanggal</th>
            <th>Jam</th>
        </tr>
        <?php $no=1; while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['patient_name'] ?></td>
            <td><?= $row['doctor_name'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['time'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
