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

// Actualizamos los libros asociados a esta editorial, poniendo NULL en lugar de borrar
$stmt_libros = $conexion->prepare("UPDATE libros SET editorial = NULL WHERE editorial = ?");
$stmt_libros->bind_param("s", $ruc);
$stmt_libros->execute();

// Luego eliminamos la editorial
$stmt = $conexion->prepare("DELETE FROM editoriales WHERE RUC = ?");
$stmt->bind_param("s", $ruc);
$stmt->execute();

header("Location: listar.php");
exit();
