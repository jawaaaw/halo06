<?php
//doctor_list.php
session_start();
include '../../includes/db.php';   // ✅ benar


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Hapus dokter
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM doctors WHERE id=$id");
    header("Location: doctor_list.php");
    exit();
}

// Ambil semua dokter
$result = mysqli_query($conn, "SELECT * FROM doctors");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Dokter</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff9f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      background: #f5e9dc;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.07);
    }

    h1 {
      text-align: center;
      color: #4b3f3f;
      margin-bottom: 30px;
    }

    .nav {
      margin-bottom: 20px;
    }

    .nav a {
      text-decoration: none;
      color: #d37691;
      font-weight: 600;
    }

    .add-btn {
      display: inline-block;
      background-color: #f2a1b3;
      color: white;
      padding: 10px 20px;
      border-radius: 12px;
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 20px;
      transition: background 0.3s ease;
    }

    .add-btn:hover {
      background-color: #e28ca0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fffdfb;
      border-radius: 12px;
      overflow: hidden;
    }

    th, td {
      padding: 14px 20px;
      text-align: center;
      border-bottom: 1px solid #d3c5b8;
    }

    th {
      background-color: #f2d8cd;
      color: #4b3f3f;
    }

    tr:hover {
      background-color: #fdf1ed;
    }

    .aksi a {
      text-decoration: none;
      color: #d37691;
      font-weight: 600;
      margin: 0 6px;
    }

    .aksi a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Daftar Dokter</h1>

    <div class="nav">
      <a href="../admin_dashboard.php">← Kembali ke Dashboard</a>
    </div>

    <a href="add_doctor.php" class="add-btn">+ Tambah Dokter</a>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Spesialisasi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>drg. Puti</td>
          <td>Umum</td>
          <td class="aksi">
            <a href="edit_doctor.php?id=1">Edit</a> |
            <a href="delete_doctor.php?id=1">Delete</a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>drg. Rahmah</td>
          <td>Umum</td>
          <td class="aksi">
            <a href="edit_doctor.php?id=2">Edit</a> |
            <a href="delete_doctor.php?id=2">Delete</a>
          </td>
        </tr>
        <!-- Tambahkan data dari PHP nanti -->
      </tbody>
    </table>
  </div>
</body>
</html>
