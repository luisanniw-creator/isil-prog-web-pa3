<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = intval($_POST['codigo']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $carrera = trim($_POST['carrera']);
    $telefono = trim($_POST['telefono']);

    $sql = "UPDATE estudiantes SET nombre = ?, apellido = ?, carrera = ?, telefono = ? WHERE codigo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $apellido, $carrera, $telefono, $codigo);
    $stmt->execute();
}

header("Location: listar.php");
exit();
