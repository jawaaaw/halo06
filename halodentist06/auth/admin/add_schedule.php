<?php
session_start();
include '../../config.php';         // Untuk BASE_URL jika digunakan
include '../../includes/db.php';   // Koneksi ke database

// Cek session admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: " . BASE_URL . "auth/login.php");  // Redirect login
    exit();
}

// Proses simpan jadwal jika form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama'];
    $dokter = $_POST['dokter'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $tindakan = $_POST['tindakan'];

    $query = "INSERT INTO jadwal (nama, dokter, tanggal, jam, tindakan) 
              VALUES ('$nama', '$dokter', '$tanggal', '$jam', '$tindakan')";

    mysqli_query($conn, $query);
    header("Location: schedule_list.php"); // Atau ke halaman list jadwal
    exit();
}

// ambil daftar dokter dari database jika ingin dinamis
$doctors = mysqli_query($conn, "SELECT * FROM doctors");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Jadwal Pasien</title>
  <style>
    /* ... CSS tetap seperti yang kamu buat ... */
  </style>
</head>
<body>
  <div class="container">
    <h1>Tambah Jadwal Pasien</h1>

    <div class="nav">
  <a href="<?= BASE_URL ?>auth/admin/admin_dashboard.php">Dashboard</a>
</div>

    <form action="add_schedule.php" method="POST">
      <label for="nama">Nama Pasien:</label>
      <input type="text" id="nama" name="nama" required>

      <label for="dokter">Dokter:</label>
      <select id="dokter" name="dokter" required>
        <option value="">-- Pilih Dokter --</option>
        <option value="drg_puti">drg. Puti - Umum</option>
        <option value="drg_rani">drg. Rahmah - Umum</option>
        <option value="drg_miya">drg. Miya - Umum</option>
        <option value="drg_najla">drg. Najla - Spesialis Bedah Mulut</option>
      </select>

      <label for="tanggal">Tanggal:</label>
      <input type="date" id="tanggal" name="tanggal" required>

      <label for="jam">Jam:</label>
      <input type="time" id="jam" name="jam" required>

      <label for="tindakan">Tindakan:</label>
      <textarea id="tindakan" name="tindakan" rows="3" required></textarea>

      <button type="submit">Simpan Jadwal</button>
    </form>
  </div>
</body>
</html>
