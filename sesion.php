<?php
session_start();

// Si no hay sesión iniciada, regresa al login
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit;
}
?>
