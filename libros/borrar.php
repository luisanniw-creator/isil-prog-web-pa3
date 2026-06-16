<?php
// 1. INICIAR SESIÓN Y CONTROL DE ACCESO
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

// 2. CONEXIÓN A LA BASE DE DATOS
include '../conexion.php';

// 3. CAPTURAR EL VALOR DESDE LA URL
$codigo = $_GET['codigo'];

// 4. CONSULTA DE ELIMINACIÓN
// Cambiamos la tabla 'usuario' por 'libros' y filtramos por 'codigo'
$sql = "DELETE FROM libros WHERE codigo = ?";

// 5. PREPARAR Y EJECUTAR (Con tu objeto $conexion de MySQLi)
$stmt = $conexion->prepare($sql);

// Enlazamos el parámetro: 'i' indica que el código es un número entero
$stmt->bind_param("i", $codigo);

$stmt->execute();

// 6. REDIRECCIÓN
// Después de borrar, regresamos al listado de libros para ver el cambio en vivo
header("Location: listar.php");
exit();
