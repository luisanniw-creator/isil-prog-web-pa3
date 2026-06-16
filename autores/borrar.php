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

// Actualizamos los libros asociados a este autor, poniendo NULL en lugar de borrar
$stmt_libros = $conexion->prepare("UPDATE libros SET autor = NULL WHERE autor = ?");
$stmt_libros->bind_param("i", $dni);
$stmt_libros->execute();

// Luego eliminamos el autor
$stmt = $conexion->prepare("DELETE FROM autores WHERE DNI = ?");
$stmt->bind_param("i", $dni);
$stmt->execute();

header("Location: listar.php");
exit();
