<?php
// 1. Iniciar sesión y validar acceso (Para que no salga "Invitado" ni entren sin loguearse)
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
$usuario = $_SESSION['usuario'];

// 2. Corregimos la ruta para salir de la carpeta del módulo y encontrar conexion.php
include '../conexion.php';

// Aseguramos que la petición venga por POST antes de intentar registrar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // La tabla es 'estudiantes' con sus 5 columnas correspondientes
    $sql = "INSERT INTO estudiantes (codigo, nombre, apellido, carrera, telefono) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    // CORRECCIÓN: "issss" -> 'i' para el código (INT) y 'ssss' para nombre, apellido, carrera y teléfono (VARCHAR)
    $stmt->bind_param("issss", $_POST['codigo'], $_POST['nombre'], $_POST['apellido'], $_POST['carrera'], $_POST['telefono']);

    $stmt->execute();

    // Redirigimos al listado de estudiantes tras guardar
    header("Location: listar.php");
    exit();
}
