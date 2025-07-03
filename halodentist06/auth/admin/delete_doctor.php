<?php
session_start();
include '../../includes/db.php';   // ✅ benar


if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
$query = "DELETE FROM doctors WHERE id = $id";
mysqli_query($conn, $query);

header('Location: admin_dashboard.php');
