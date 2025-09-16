<?php
// filepath: c:\xampp\htdocs\prilist\auth_check.php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>