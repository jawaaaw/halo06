<?php
session_start();
include '../../config.php';
include '../../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: " . BASE_URL . "auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin | Halo Dentist</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #d63384;
      --bg-light: #fff0f5;
      --hover-bg: #fdd3e9;
      --text: #3a003a;
      --accent: #ff4081;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #fff9fb;
    }
    .navbar {
      background-color: var(--bg-light);
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    .logo {
      font-size: 1.6rem;
      font-weight: bold;
      color: var(--primary);
    }
    .navbar ul {
      list-style: none;
      display: flex;
      gap: 20px;
      margin: 0;
      padding: 0;
    }
    .navbar ul li a {
      text-decoration: none;
      color: var(--text);
      padding: 10px 16px;
      border-radius: 10px;
      transition: background 0.3s;
      font-weight: 500;
    }
    .navbar ul li a:hover {
      background-color: var(--hover-bg);
    }
    .logout-btn {
      background-color: var(--accent);
      color: white !important;
    }
    .logout-btn:hover {
      background-color: #e6005c;
    }
    .main {
      padding: 50px 60px;
    }
    .main h1 {
      color: var(--primary);
      font-size: 2.2rem;
      margin-bottom: 10px;
    }
    .main p {
      font-size: 1.05rem;
      color: #444;
    }
    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 24px;
      margin-top: 40px;
    }
    .card {
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.06);
      padding: 26px;
      transition: 0.3s;
      border-left: 6px solid var(--primary);
    }
    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 18px rgba(0,0,0,0.08);
    }
    .card h3 {
      margin-bottom: 12px;
      color: var(--primary);
    }
    .card p {
      color: #666;
      font-size: 0.95rem;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar">
    <div class="logo">Halo Dentist</div>
    <ul>
      <li><a href="<?= BASE_URL ?>auth/admin/edit_doctor.php">Edit Dokter</a></li>
      <li><a href="<?= BASE_URL ?>auth/admin/add_schedule.php">Buat Jadwal</a></li>
      <li><a href="<?= BASE_URL ?>auth/admin/doctor_list.php">Semua Jadwal</a></li>
      <li><a href="<?= BASE_URL ?>includes/doctors.php">Cari Jadwal</a></li>
      <li><a href="<?= BASE_URL ?>genetic/genetic_schedule.php">Jadwal Otomatis</a></li>
      <li><a href="<?= BASE_URL ?>auth/admin/logout.php" class="logout-btn">Logout</a></li>
    </ul>
  </nav>

  <!-- MAIN CONTENT -->
  <main class="main">
    <h1>Selamat datang, Admin!</h1>
    <p>Silakan pilih menu di atas untuk mengelola sistem penjadwalan Halo Dentist.</p>

    <div class="card-grid">
      <div class="card">
        <h3>🏥 Data Dokter</h3>
        <p>Kelola informasi dan jadwal praktik dokter dengan praktis dan cepat.</p>
      </div>
      <div class="card">
        <h3>⏰ Jadwal Pasien</h3>
        <p>Buat dan atur reservasi pasien dalam satu klik.</p>
      </div>
      <div class="card">
        <h3>📅 Semua Jadwal</h3>
        <p>Pantau jadwal keseluruhan klinik, semua tersedia di satu tampilan.</p>
      </div>
      <div class="card">
        <h3>🔎 Cari Jadwal</h3>
        <p>Temukan jadwal dokter dengan fitur pencarian canggih.</p>
      </div>
    </div>
  </main>

</body>
</html>
