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

    // La tabla es 'categoria' (en singular según tu base de datos)
    $sql = "INSERT INTO categoria (codigo, categoria, descripcion) VALUES (?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    // CORRECCIÓN AQUÍ: 
    // "iss" -> 'i' porque el código es INT (entero), 's' para la categoría (varchar) y 's' para descripción (text)
    $stmt->bind_param("iss", $_POST['codigo'], $_POST['categoria'], $_POST['descripcion']);

    $stmt->execute();

    // Redirigimos al listado de categorías tras guardar
    header("Location: listar.php");
    exit();
}
