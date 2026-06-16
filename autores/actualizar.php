<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = intval($_POST['DNI']);
    $nombre = trim($_POST['nombre']);
    $nacionalidad = trim($_POST['nacionalidad']);

    $sql = "UPDATE autores SET nombre = ?, nacionalidad = ? WHERE DNI = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $nacionalidad, $dni);
    $stmt->execute();
}

header("Location: listar.php");
exit();
