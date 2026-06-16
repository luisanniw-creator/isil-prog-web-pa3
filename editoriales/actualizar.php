<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ruc = trim($_POST['ruc']);
    $nombre = trim($_POST['nombre_editorial']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);

    $sql = "UPDATE editoriales SET nombre_Editorial = ?, direccion = ?, telefono = ? WHERE RUC = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $direccion, $telefono, $ruc);
    $stmt->execute();
}

header("Location: listar.php");
exit();
