<?php

$conexion = new mysqli("localhost", "root", "Luisa.21", "biblioteca");

$usuario = "root";
$password = password_hash("123456", PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios(usuario, password)
        VALUES('$usuario', '$password')";

if ($conexion->query($sql)) {
    echo "Usuario creado";
} else {
    echo "Error";
}
