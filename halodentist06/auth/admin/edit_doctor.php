<?php
//edit_doctor.php
session_start();
include '../../includes/db.php';   // ✅ benar

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Default kosong
$data = [
    'name' => '',
    'specialty' => '',
    'schedule' => ''
];

// Cek ID dari URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM doctors WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    }
}

// Saat tombol simpan ditekan
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $specialty = mysqli_real_escape_string($conn, $_POST['specialty']);
    $schedule = mysqli_real_escape_string($conn, $_POST['schedule']);

    // Jika ID valid, lakukan update
    if (isset($id)) {
        $update = "UPDATE doctors SET name='$name', specialty='$specialty', schedule='$schedule' WHERE id=$id";
        mysqli_query($conn, $update);
    }

    header('Location: admin_dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Dokter</title>
  <style>
  body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #fff9f4; /* cream lembut */
    margin: 0;
    padding: 0;
  }
  .container {
    max-width: 600px;
    background: #f5e9dc; /* coklat susu terang */
    margin: 50px auto;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
  }
  h1 {
    text-align: center;
    color: #4b3f3f; /* coklat lembut */
    margin-bottom: 30px;
  }
  label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #4b3f3f;
  }
  input[type="text"],
  textarea {
    width: 100%;
    padding: 10px 14px;
    margin-bottom: 20px;
    border: 1px solid #d3c5b8;
    border-radius: 10px;
    background-color: #fffdfb;
    color: #4b3f3f;
  }
  button {
    background-color: #f2a1b3; /* pink pastel */
    color: white;
    border: none;
    padding: 12px;
    font-size: 16px;
    border-radius: 10px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #e28ca0; /* pink tua */
  }
  .nav {
    text-align: center;
    margin-bottom: 25px;
  }
  .nav a {
    text-decoration: none;
    margin: 0 12px;
    color: #d37691;
    font-weight: 600;
  }
  .nav a:hover {
    text-decoration: underline;
  }
</style>

</head>
<body>
  <div class="container">
    <h1>Edit Dokter</h1>
    
    <div class="nav">
      <a href="../admin_dashboard.php">Dashboard</a>
      <a href="../logout.php">Logout</a>
    </div>

    <form action="edit_doctor.php" method="POST">
      <label for="nama">Nama:</label>
      <input type="text" id="nama" name="nama" required>

      <label for="spesialis">Spesialis:</label>
      <input type="text" id="spesialis" name="spesialis" required>

      <label for="jadwal">Jadwal:</label>
      <textarea id="jadwal" name="jadwal" rows="3" required></textarea>

      <button type="submit">Simpan Perubahan</button>
    </form>
  </div>
</body>
</html>
