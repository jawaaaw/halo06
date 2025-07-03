<?php
// logout_patient.php
session_start();
session_unset();
session_destroy();
header("Location: login_patient.php");
exit();
