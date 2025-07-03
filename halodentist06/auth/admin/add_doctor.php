<?php
// admin/add_doctor.php
include '../includes/db.php';
session_start();


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $specialty = mysqli_real_escape_string($conn, $_POST['specialty']);
    $schedule = mysqli_real_escape_string($conn, $_POST['schedule']);

    $query = "INSERT INTO doctors (name, specialty, schedule) VALUES ('$name', '$specialty', '$schedule')";
    mysqli_query($conn, $query);

    header("Location: doctor_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Dokter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Tambah Dokter</h1>
    <nav>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="doctor_list.php">Kembali</a>
    </nav>
</header>
<main>
    <form method="POST">
        <label>Nama:</label>
        <input type="text" name="name" required>

        <label>Spesialisasi:</label>
        <input type="text" name="specialty" required>

        <label>Jadwal:</label>
        <textarea name="schedule" required></textarea>

        <input type="submit" name="submit" value="Tambah Dokter">
    </form>
</main>
</body>
</html>
