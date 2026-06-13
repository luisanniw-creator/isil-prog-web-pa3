<?php
$host = "localhost";
$db = "biblioteca";
$user = "root";
$pass = "Luisa.21";

try {

    $conexion = new PDO(
        "mysql:host=$host;dbname=$db",
        $user,
        $pass
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch(PDOException $e) {

    die("Error: " . $e->getMessage());

}
?>
