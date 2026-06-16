<?php
// 1. Iniciar sesión y validar acceso (Para que no salga "Invitado" ni entren sin loguearse)
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
$usuario = $_SESSION['usuario'];

// 2. Corregimos la ruta para salir de la carpeta "libros" y encontrar conexion.php
include '../conexion.php';

// Aseguramos que la petición venga por POST antes de intentar registrar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // CORRECCIÓN: Usamos las columnas reales de la tabla 'libros'
    $sql = "INSERT INTO libros (codigo, titulo, editorial, fecha) VALUES (?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    // CORRECCIÓN: "isss" -> 'i' porque el código es INT (entero), y 'sss' para titulo, editorial y fecha (date)
    $stmt->bind_param("isss", $_POST['codigo'], $_POST['titulo'], $_POST['editorial'], $_POST['fecha']);

    $stmt->execute();

    // Redirigimos de vuelta al index de la raíz tras guardar con éxito
    header("Location: ../index.php");
    exit();
}
