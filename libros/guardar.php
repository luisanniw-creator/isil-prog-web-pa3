<?php

include 'conexion.php';

$sql = "INSERT INTO usuario
(DNI,nombre,nacionalidad)
VALUES
(:DNI,:nombre,:nacionalidad)";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(':DNI', $_POST['DNI']);
$stmt->bindParam(':nombre', $_POST['nombre']);
$stmt->bindParam(':nacionalidad', $_POST['nacionalidad']);

$stmt->execute();

header("Location:index.php");
