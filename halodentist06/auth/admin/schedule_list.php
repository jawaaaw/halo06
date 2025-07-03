<?php
session_start();
include '../../includes/db.php';


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT schedules.*, doctors.name AS doctor_name 
          FROM schedules 
          JOIN doctors ON schedules.doctor_id = doctors.id 
          ORDER BY date, time";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Pasien</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h2>Jadwal Konsultasi Pasien</h2>
    <nav>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="add_schedule.php">Tambah Jadwal</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>
<main>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Pasien</th>
            <th>Dokter</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>$no</td>
                    <td>{$row['patient_name']}</td>
                    <td>{$row['doctor_name']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['time']}</td>
                    <td>
                        <a href='edit_schedule.php?id={$row['id']}'>Edit</a> |
                        <a href='delete_schedule.php?id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus?');\">Hapus</a>
                    </td>
                  </tr>";
            $no++;
        }
        ?>
    </table>
</main>
</body>
</html>
