<?php

$conexion = new mysqli("localhost", "root", "Luisa.21", "biblioteca");

if ($conexion->connect_error) {
    die("Error de conexión");
}
?>
