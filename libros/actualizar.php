<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo'];
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $editorial = trim($_POST['editorial']);
    $anio = trim($_POST['anio']);

    // Ejecutamos la actualización apuntando a tu columna real 'año'
    $sql = "UPDATE libros SET titulo = ?, autor = ?, editorial = ?, año = ? WHERE codigo = ?";
    $stmt = $conexion->prepare($sql);

    // "ssssi" -> 4 cadenas de texto y 1 entero (el código)
    $stmt->bind_param("ssssi", $titulo, $autor, $editorial, $anio, $codigo);
    $stmt->execute();
}

// Redirección automática al listado de libros
header("Location: listar.php");
exit();
