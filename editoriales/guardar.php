<?php
// 1. Iniciar sesión y validar acceso
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

    // La tabla es 'editoriales' con sus 4 columnas correspondientes
    $sql = "INSERT INTO editoriales (RUC, nombre_Editorial, direccion, telefono) VALUES (?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    // Usamos los mismos nombres que en el formulario de registrar.php
    $ruc = trim($_POST['ruc']);
    $nombre = trim($_POST['nombre_editorial']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);

    // "ssss" -> Las 4 columnas son VARCHAR en la base de datos
    $stmt->bind_param("ssss", $ruc, $nombre, $direccion, $telefono);

    $stmt->execute();

    // Redirigimos al listado de editoriales tras guardar
    header("Location: listar.php");
    exit();
}
