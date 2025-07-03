<?php
//delete_schedule.php
session_start();
include '../includes/db.php';


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM schedules WHERE id = $id";
    mysqli_query($conn, $query);
}

header("Location: schedule_list.php");
exit();
