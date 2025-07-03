<?php
session_start();
include '../includes/db.php';


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? 0;
$result = mysqli_query($conn, "SELECT * FROM schedules WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Jadwal tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_name = $_POST['patient_name'];
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Validasi bentrok jadwal baru dengan data lain (kecuali data ini sendiri)
    $cek = mysqli_query($conn, "SELECT * FROM schedules WHERE doctor_id='$doctor_id' AND date='$date' AND time='$time' AND id != $id");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Jadwal bentrok! Silakan pilih waktu lain.";
    } else {
        mysqli_query($conn, "UPDATE schedules SET patient_name='$patient_name', doctor_id='$doctor_id', date='$date', time='$time' WHERE id=$id");
        header("Location: schedule_list.php");
        exit();
    }
}

$doctors = mysqli_query($conn, "SELECT * FROM doctors");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Jadwal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Jadwal Pasien</h2>
    <a href="schedule_list.php">Kembali ke Jadwal</a>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Nama Pasien:</label><br>
        <input type="text" name="patient_name" value="<?= $data['patient_name'] ?>" required><br>

        <label>Dokter:</label><br>
        <select name="doctor_id" required>
            <?php while ($d = mysqli_fetch_assoc($doctors)) : ?>
                <option value="<?= $d['id'] ?>" <?= $data['doctor_id'] == $d['id'] ? 'selected' : '' ?>><?= $d['name'] ?> - <?= $d['specialty'] ?></option>
            <?php endwhile; ?>
        </select><br>

        <label>Tanggal:</label><br>
        <input type="date" name="date" value="<?= $data['date'] ?>" required><br>

        <label>Jam:</label><br>
        <input type="time" name="time" value="<?= $data['time'] ?>" required><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>