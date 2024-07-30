<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['ip'] !== $_SERVER['REMOTE_ADDR']) {
    // Redirect to login page if not authenticated
    header('Location: ../login.php?info=not_logged_in');
    exit();
}
?>