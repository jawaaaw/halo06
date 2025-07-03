<?php
$host = "127.0.0.1:3307";  // ← pakai port 3307 kalau tadi diganti
$user = "root";
$pass = "";
$db   = "skripsi_halo_dentist01";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
