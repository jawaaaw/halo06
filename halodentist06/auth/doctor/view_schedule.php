<?php
session_start();
include '../../includes/db.php';  

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Tangkap input pencarian (kalau ada)
$search_doctor = isset($_GET['doctor']) ? $_GET['doctor'] : '';
$search_date = isset($_GET['date']) ? $_GET['date'] : '';

// Query dengan filter
$query = "SELECT schedules.*, doctors.name AS doctor_name 
          FROM schedules 
          JOIN doctors ON schedules.doctor_id = doctors.id 
          WHERE 1";

if (!empty($search_doctor)) {
    $query .= " AND doctors.name LIKE '%$search_doctor%'";
}

if (!empty($search_date)) {
    $query .= " AND schedules.date = '$search_date'";
}

$query .= " ORDER BY date, time";
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
    <h1>Jadwal Konsultasi Pasien</h1>
    <nav>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="add_schedule.php">Tambah Jadwal</a>
        <a href="view_schedule.php">Lihat Semua Jadwal</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>
<main>

    <!-- 🔍 Form Pencarian -->
    <form method="get" style="margin-bottom: 20px;">
        <label>Cari Nama Dokter:</label>
        <input type="text" name="doctor" value="<?= htmlspecialchars($search_doctor) ?>" placeholder="Contoh: puti">

        <label>Tanggal:</label>
        <input type="date" name="date" value="<?= htmlspecialchars($search_date) ?>">

        <input type="submit" value="Cari">
        <a href="view_schedule.php">Reset</a>
    </form>

    <!-- Tabel Jadwal -->
    <table>
        <tr>
            <th>No</th>
            <th>Nama Pasien</th>
            <th>Dokter</th>
            <th>Tanggal</th>
            <th>Jam</th>
        </tr>
        <?php
        $no = 1;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>$no</td>
                        <td>{$row['patient_name']}</td>
                        <td>{$row['doctor_name']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['time']}</td>
                      </tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada jadwal ditemukan.</td></tr>";
        }
        ?>
    </table>
</main>
</body>
</html>
