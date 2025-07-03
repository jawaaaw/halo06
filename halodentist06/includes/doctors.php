<?php
session_start();
include '../includes/db.php' ?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Dokter - Halo Dentist</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Dokter Kami</h1>
    <nav>
        <a href="index.php">Beranda</a>
        <a href="doctors.php">Dokter</a>
        <a href="schedule.php">Penjadwalan</a>
    </nav>
</header>
<main>
    <table>
        <tr>
            <th>Nama</th>
            <th>Spesialis</th>
            <th>Jadwal</th>
        </tr>
        <?php
        $query = "SELECT * FROM doctors";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['specialty']}</td>
                    <td>{$row['schedule']}</td>
                  </tr>";
        }
        ?>
    </table>
</main>
</body>
</html>
