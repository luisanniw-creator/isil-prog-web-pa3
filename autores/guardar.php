<?php
// 1. Iniciar sesión y validar acceso (Para que no salga "Invitado" ni entren sin loguearse)
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
$usuario = $_SESSION['usuario'];

// 2. Corregimos la ruta para salir de la carpeta "autores" y encontrar conexion.php
include '../conexion.php';

// Aseguramos que la petición venga por POST antes de intentar registrar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Cambiamos la tabla a 'autores' con sus columnas respectivas
    $sql = "INSERT INTO autores (DNI, nombre, nacionalidad) VALUES (?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    // Capturamos los datos enviados desde el formulario de autores
    $stmt->bind_param("sss", $_POST['DNI'], $_POST['nombre'], $_POST['nacionalidad']);

    $stmt->execute();

    // Redirigimos al listado de autores tras guardar
    header("Location: listar.php");
    exit();
}
