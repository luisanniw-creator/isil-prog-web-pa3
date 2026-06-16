<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if (!isset($_GET['ruc'])) {
    header("Location: listar.php");
    exit();
}

$ruc = $_GET['ruc'];
$stmt = $conexion->prepare("DELETE FROM editoriales WHERE RUC = ?");
$stmt->bind_param("s", $ruc);
$stmt->execute();

header("Location: listar.php");
exit();
