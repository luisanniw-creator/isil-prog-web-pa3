<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if (!isset($_GET['dni'])) {
    header("Location: listar.php");
    exit();
}

$dni = intval($_GET['dni']);
$stmt = $conexion->prepare("DELETE FROM autores WHERE DNI = ?");
$stmt->bind_param("i", $dni);
$stmt->execute();

header("Location: listar.php");
exit();
