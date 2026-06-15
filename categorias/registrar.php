<?php
// 1. INICIAR SESIÓN
session_start();

// 2. CONTROL DE ACCESO: Si no está logueado, mandarlo al login de la raíz
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php"); // Nota los "../" para salir a la raíz
    exit();
}

// 3. RECUPERAR EL NOMBRE: Así el navbar lo puede pintar correctamente
$usuario = $_SESSION['usuario'];

// 4. AHORA SÍ TRAES EL NAVBAR
include("../navbar.php");
