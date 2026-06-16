<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if (!isset($_GET['codigo'])) {
    header("Location: listar.php");
    exit();
}

$codigo = intval($_GET['codigo']);
$stmt = $conexion->prepare("DELETE FROM categoria WHERE codigo = ?");
$stmt->bind_param("i", $codigo);
$stmt->execute();

header("Location: listar.php");
exit();
