<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = intval($_POST['codigo']);
    $categoria = trim($_POST['categoria']);
    $descripcion = trim($_POST['descripcion']);

    $sql = "UPDATE categoria SET categoria = ?, descripcion = ? WHERE codigo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $categoria, $descripcion, $codigo);
    $stmt->execute();
}

header("Location: listar.php");
exit();
