<?php
session_start();
include '../includes/db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Penjadwalan - Halo Dentist</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
    <h1>Form Penjadwalan</h1>
    <nav>
        <a href="../index.php">Beranda</a>
        <a href="doctors.php">Dokter</a>
        <a href="schedule.php">Penjadwalan</a>
    </nav>
</header>
<main>
    <form action="schedule.php" method="post">
        <label>Nama Pasien:</label>
        <input type="text" name="patient_name" required>
        <label>Pilih Dokter:</label>
        <select name="doctor_id" required>
            <?php
            $dokter = mysqli_query($conn, "SELECT * FROM doctors");
            while ($d = mysqli_fetch_assoc($dokter)) {
                echo "<option value='{$d['id']}'>{$d['name']}</option>";
            }
            ?>
        </select>
        <label>Tanggal:</label>
        <input type="date" name="date" required>
        <label>Jam:</label>
        <input type="time" name="time" required>
        <input type="submit" name="submit" value="Buat Janji">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['patient_name'];
        $doctor_id = $_POST['doctor_id'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        $sql = "INSERT INTO schedules (patient_name, doctor_id, date, time)
                VALUES ('$name', '$doctor_id', '$date', '$time')";

        if (mysqli_query($conn, $sql)) {
            echo "<p>Jadwal berhasil dibuat!</p>";
        } else {
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    ?>
</main>
</body>
</html>
